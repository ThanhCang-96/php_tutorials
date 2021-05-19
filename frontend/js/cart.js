$(document).ready(function(){
  $("a.cart_quantity_up").click(function(){
    var getId = $(this).closest("tr").find("p.id").text();
    var getPrice = $(this).closest("tr").find("p.price").text();
    getPrice = parseInt(getPrice.slice(1,getPrice.length))
    var getQty = parseInt($(this).next().val()) + 1
    $(this).next().val(getQty)
    var into_money = getPrice * getQty;
    $(this).closest("tr").find("p.cart_total_price").text("$"+into_money)

    $.ajax({
      method: "POST",// phương thức dữ liệu được truyền đi
      url: "ajax_qty_up.php",// gọi đến file server show_data.php để xử lý
      data: {
        getId: getId
      },//lấy toàn thông tin các fields trong form bằng hàm serialize của jquery
      success : function(response){//kết quả trả về từ server nếu gửi thành công
        console.log(response);
      }
    })
  });

  $("a.cart_quantity_down").click(function(){
    var getId = $(this).closest("tr").find("p.id").text();
    var getPrice = $(this).closest("tr").find("p.price").text();
    getPrice = parseInt(getPrice.slice(1,getPrice.length))
    var getQty = parseInt($(this).prev().val()) - 1
    if (getQty == 0) {

      // xoá hmtl
      $(this).closest("tr").remove()

      // cập nhật số lượng sản phẩm trong giỏ hàng
      var qty = parseInt($('a.qty').text()) - 1
      if (qty > 0) {
        $('a.qty').text(qty)
      } else $('a.qty').text("Cart")
    } else {
      $(this).prev().val(getQty)
      var into_money = getPrice * getQty;
      $(this).closest("tr").find("p.cart_total_price").text("$"+into_money)
    }
    $.ajax({
      method: "POST",// phương thức dữ liệu được truyền đi
      url: "ajax_qty_down.php",// gọi đến file server show_data.php để xử lý
      data: {
        getId: getId
      },//lấy toàn thông tin các fields trong form bằng hàm serialize của jquery
      success : function(response){//kết quả trả về từ server nếu gửi thành công
        console.log(response);
      }
    })
  });

  $("a.cart_quantity_delete").click(function(){
    var getId = $(this).closest("tr").find("p.id").text();
    $(this).closest("tr").remove()
    var qty = parseInt($('a.qty').text()) - 1
    if (qty > 0) {
      $('a.qty').text(qty)
    } else $('a.qty').text("Cart")
    $.ajax({
      method: "POST",// phương thức dữ liệu được truyền đi
      url: "ajax_delete.php",// gọi đến file server show_data.php để xử lý
      data: {
        proId: getId
      },//lấy toàn thông tin các fields trong form bằng hàm serialize của jquery
      success : function(response){//kết quả trả về từ server nếu gửi thành công
        console.log(response.data);
        // $('input.cart_quantity_input'+getId).val(response)
      }
    });
  })
})