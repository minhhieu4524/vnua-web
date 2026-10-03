const form = document.querySelector("#form");
const oTen = document.querySelector("#o-ten"); 
const ds = document.querySelector("#ds");


// Xử lý sự kiện thêm món mới
form.addEventListener("submit", (e) => {
    e.preventDefault(); // Không để trang load lại
    const ten = oTen.value.trim();
    if (ten === "") return; // null thì bỏ qua

    // Tạo dòng mới (li)
    const li = document.createElement("li");

    // Tên món ăn (span)
    const span = document.createElement("span");
    span.textContent = ten;

    // Nút xóa
    const nutXoa = document.createElement("button");
    nutXoa.type = "button"; // Không submit form
    nutXoa.textContent = "Xóa";
    nutXoa.addEventListener("click", (e) => {
        li.remove();
        capNhatThongKe();
    });

    // Bấm 1 lần vào li -> đánh dấu đã mua / chưa mua (gạch ngang)
    li.addEventListener("click", () => {
        li.classList.toggle("completed");
        capNhatThongKe();
    });

    // Nháy đúp -> xóa món
    li.addEventListener("dblclick", () => {
        li.remove();
        capNhatThongKe();
    });

    // Ghép span vào li, rồi gán li vào danh sách (ds)
    li.append(span, nutXoa);
    ds.append(li);
   
    oTen.value = ""; // Xóa nội dung ô input
    oTen.focus(); // Sẵn sàng nhập món ăn tiếp theo
});

// Chạy lần đầu khi load trang
capNhatThongKe();