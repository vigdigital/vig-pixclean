# VIG PixClean

Công cụ web **xoá dấu vết AI & metadata khỏi ảnh**, chạy 100% trong trình duyệt — ảnh không rời khỏi máy, không có server, không upload.

## Chức năng

- Kéo-thả / chọn ảnh **PNG · JPG · WEBP**, đọc & liệt kê mọi metadata ẩn:
  - **C2PA / Content Credentials** (chữ ký "tạo bởi AI" của ChatGPT, Gemini, Firefly…)
  - **EXIF / GPS**, **XMP**, **IPTC**, chú thích ẩn (tEXt/iTXt/zTXt, COM)
- Gắn nhãn **AI** vs **META**, mô tả tiếng Việt từng mục.
- **Xoá metadata** — giữ nguyên pixel, không giảm chất lượng (lossless).
- **Xử lý lại pixel** — vẽ & nén lại ảnh để làm mờ watermark ẩn kiểu SynthID nằm trong điểm ảnh.
- Giao diện sáng/tối, không phụ thuộc thư viện ngoài (chỉ Google Fonts).

## Chạy local

Mở thẳng file:

```bash
open index.html
```

Hoặc chạy như web server:

```bash
python3 -m http.server 8747
# rồi mở http://localhost:8747
```

## Kỹ thuật

Toàn bộ nằm trong **một file `index.html`** (HTML + CSS + JS thuần, không build).
Parser đọc trực tiếp cấu trúc file để tìm & loại bỏ chunk/segment metadata:

- **PNG** — giữ lại `IHDR/PLTE/IDAT/IEND` (+ chunk màu), loại `caBX` (C2PA), `eXIf`, `tEXt/iTXt/zTXt`.
- **JPEG** — loại `APP1` (EXIF/XMP), `APP11` (C2PA/JUMBF), `APP13` (IPTC), `APP14` (Adobe), `COM`; giữ ảnh nguyên vẹn.
- **WEBP** — loại chunk `EXIF`/`XMP`, xoá cờ tương ứng trong `VP8X`.

Tuỳ chọn "xử lý lại pixel" dùng `<canvas>` re-encode — cách này xoá sạch mọi metadata **và** thay đổi pixel.

## Lưu ý

Xoá metadata gỡ được chữ ký C2PA và thông tin ẩn trong file, nhưng **không** đụng tới watermark nhúng trong điểm ảnh. Muốn giảm loại đó phải **xử lý lại pixel** / resize / chụp lại — và vẫn không đảm bảo mất hoàn toàn.

---

© VIG — công cụ nội bộ.
