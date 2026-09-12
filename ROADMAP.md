# Roadmap — VIG PixClean

Ghi chú cho các phiên bản sau. Chỉ liệt kê thứ **đáng làm**, ưu tiên theo giá trị/công sức. Không cam kết làm hết.

---

## v2 — ưu tiên cao (giá trị rõ, công sức vừa)

### 1. Ghi IPTC / XMP "chính danh" (bản quyền & credit)
Chế độ tùy chọn ghi metadata hợp lệ sau khi làm sạch:
- `Creator` (tác giả), `Copyright Notice`, `Credit Line`
- `Web Statement of Rights` + `Licensor URL` → Google Images hiện badge **"Licensable"** + mục "Image credits"
- `Title` / `Description` (một số CMS tự đọc để điền alt/caption)

**Vì sao:** đúng thứ Google thật sự đọc từ file; bảo vệ attribution khi ảnh bị scrape; hợp khi giao ảnh cho khách (minh bạch, VIG + khách cùng phía).
**Kỹ thuật:** XMP = chuỗi XML nhúng (dễ). JPEG APP1/APP13, PNG iTXt, WEBP XMP-chunk. EXIF đầy đủ dùng `piexifjs` nếu cần.
**Không làm:** ngụy tạo EXIF máy ảnh (Make/Model/GPS giả) — giả mạo nguồn gốc, rủi ro uy tín.

### 2. Xử lý hàng loạt (batch)
Kéo-thả nhiều ảnh cùng lúc → làm sạch tất cả → tải về `.zip`.
**Vì sao:** workflow agency thường xử lý cả bộ ảnh, không phải từng tấm.
**Kỹ thuật:** loop qua nhiều file + gom bằng JSZip (client-side).

### 3. Nén / xuất tối ưu web (đòn bẩy SEO thật)
Kiểm soát nén tốt hơn: xuất **WebP**, nén theo dung lượng mục tiêu, hiển thị "trước/sau".
**Vì sao:** dung lượng/format ảnh → **Core Web Vitals = yếu tố xếp hạng**. Đây là phần SEO ảnh giá trị nhất từ chính công cụ.

---

## v2+ — cân nhắc (nice-to-have)

### 4. Xoá chọn lọc thay vì xoá tất cả
Bật/tắt từng nhóm: chỉ xoá **GPS** nhưng giữ EXIF hữu ích (cho ảnh chụp thật), hoặc chỉ xoá C2PA.

### 5. Trợ lý SEO ảnh (ngoài file)
Gợi ý **tên file chuẩn** + khung **alt text** + snippet **structured data `ImageObject`** để dán vào CMS.
**Lưu ý:** đây là phần SEO nằm ở HTML, không phải metadata nhúng — nhưng đúng chỗ Google dùng nhiều nhất.

---

## Ghi chú kỹ thuật đã chốt

- **Không giúp SEO ranking:** EXIF máy ảnh, nhồi keyword vào IPTC Keywords → Google phần lớn strip/bỏ qua.
- **SEO ảnh thật sự** phần lớn ở HTML: `alt`, tên file, caption/ngữ cảnh, structured data, image sitemap, tốc độ trang.
- Metadata nhúng đáng ghi nhất = **IPTC credit/copyright/licensable** (mục 1).

---

## Cách deploy (nhắc lại)

```bash
# sửa index.html xong:
scp index.html vigdigit@<server>:~/tools.vigdigital.com/pixclean/
```
Chi tiết hạ tầng: xem doc nội bộ `Hosting/tools.vigdigital.com.md` (không đưa vào repo public này).
