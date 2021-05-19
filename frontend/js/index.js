$(document).ready(function(){
  $("a.add-to-cart").click(function(){
    var getId = $(this).closest("div.single-products").find("p.id").text();

    $.ajax({
      method: "POST",// phương thức dữ liệu được truyền đi
      url: "ajax.php",// gọi đến file server show_data.php để xử lý
      data: {
        id: getId
      },//lấy toàn thông tin các fields trong form bằng hàm serialize của jquery
      success : function(response){//kết quả trả về từ server nếu gửi thành công
        console.log(response);
        if (response.length > 3) {
          alert(response);
        } else $('a.qty').text(response)
      }
    });
  })
})