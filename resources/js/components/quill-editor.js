import Quill from "quill";
import "quill/dist/quill.snow.css";

/**
 * Inisialisasi Quill rich text editor pada elemen #quill-editor.
 * Konten di-sync ke hidden input #quill-content sebelum submit.
 *
 * Upload gambar inline dikirim ke /news/upload-image via POST,
 * lalu hasilnya di-insert sebagai tag <img> ke dalam editor.
 */
export function initQuillEditor() {
    const editorEl = document.querySelector("#quill-editor");
    const contentEl = document.querySelector("#quill-content");

    if (!editorEl || !contentEl) return;

    const uploadUrl = editorEl.dataset.uploadUrl;
    const csrfToken = document.querySelector(
        'meta[name="csrf-token"]',
    )?.content;

    // ── Custom image handler ─────────────────────────────────────────────────
    function imageHandler() {
        const input = document.createElement("input");
        input.setAttribute("type", "file");
        input.setAttribute("accept", "image/*");
        input.click();

        input.addEventListener("change", async () => {
            const file = input.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append("image", file);

            try {
                const response = await fetch(uploadUrl, {
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": csrfToken },
                    body: formData,
                });
                const data = await response.json();
                if (data.url) {
                    const range = quill.getSelection(true);
                    quill.insertEmbed(range.index, "image", data.url);
                    quill.setSelection(range.index + 1);
                }
            } catch (e) {
                console.error("Image upload failed", e);
            }
        });
    }

    // ── Quill init ───────────────────────────────────────────────────────────
    const quill = new Quill("#quill-editor", {
        theme: "snow",
        placeholder: "Tulis isi berita di sini...",
        modules: {
            toolbar: {
                container: [
                    [{ header: [2, 3, false] }],
                    ["bold", "italic", "underline", "strike"],
                    [{ list: "ordered" }, { list: "bullet" }],
                    [{ align: [] }],
                    ["blockquote", "code-block"],
                    ["link", "image"],
                    ["clean"],
                ],
                handlers: { image: imageHandler },
            },
        },
    });

    // Isi editor dari nilai existing (edit mode).
    // Konten disimpan di data-content sebagai JSON string (via Js::from di Blade)
    // agar tidak terjadi double-escaping saat Blade render {{ }}.
    const existing = JSON.parse(editorEl.dataset.content || '""');
    if (existing) {
        quill.clipboard.dangerouslyPasteHTML(existing);
    }

    // Helper: cek apakah konten Quill benar-benar kosong (hanya placeholder)
    function getQuillHTML() {
        const html = quill.root.innerHTML;
        // Quill mengisi "<p><br></p>" saat editor kosong
        return html === "<p><br></p>" ? "" : html;
    }

    // Sync ke hidden input segera — dangerouslyPasteHTML butuh satu tick
    // untuk selesai me-render, gunakan setTimeout(0) agar DOM ter-update dulu
    setTimeout(() => {
        contentEl.value = getQuillHTML();
    }, 0);

    // Sync ke hidden input setiap kali konten berubah
    quill.on("text-change", () => {
        contentEl.value = getQuillHTML();
    });

    // Sync ke hidden input sebelum form submit (fallback)
    editorEl.closest("form").addEventListener("submit", () => {
        contentEl.value = getQuillHTML();
    });
}
