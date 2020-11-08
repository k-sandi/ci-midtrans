<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upyourgadget | Checkout </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="<PASTE CLIENT KEY DI SINI>"></script>
            <!-- 
            contoh :
            data-client-key="xxjhash1idhfksdnfnsdjkjVy"></script> 
            -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
<!-- Image and text -->
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">
    <img src="<?php echo base_url(); ?>asset/img/gadgetin.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
    Checkout
    </a>
</nav>
<center>
<h1>Isi Form Checkout!</h1>
<h5>Catt: Pada saat pemilihan metode pembayaran harap pilih Bank Transfer-->BCA</h5>
<h5>Why? Agar sesuai alur, karena diakhir akan ada link untuk simulator pembayaran Midtrans with BCA</h5>
<div class="container mt-5">
    <form id="payment-form" method="post" action="<?=site_url()?>/snap/finish">
        <input type="hidden" name="result_type" id="result-type" value=""></div>
        <input type="hidden" name="result_data" id="result-data" value=""></div>
        <div class="form-row">
            <div class="col">
                <input type="text" class="form-control" name="fname" id="fname"  placeholder="Nama Depan">
            </div>
            <div class="col">
                <input type="text" class="form-control" name="lname" id="lname"  placeholder="Nama Belakang">
            </div>
        </div>
        <br/>
        <div class="form-row">
            <div class="col">
                <input type="number" class="form-control" name="phone" id="phone" placeholder="No.HP: eg. 6281234569">
            </div>
            <div class="col">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email: eg. yourmail@example.com">
            </div>
        </div>
        <br/>
        <div class="form-row">
            <div class="col">
                <textarea name="alamat" class="form-control" id="alamat" rows="5" placeholder="Alamat Lengkap"></textarea>
            </div>
        </div>
        <br/>
        <div class="form-row">
            <div class="col">
                <select name="productName" id="productName" class="form-control">
                    <option value="">--- Pilih Jenis Produk ---</option>
                    <option value="Customcase">Customcase</option>
                </select>
            </div>
            <div class="col">
                <select name="productPrice" id="productPrice" class="form-control">
                    <option value="">--- Pilih Produk ---</option>
                    <option value="85000">Customcase 3D | 85000</option>
                    <option value="55000">Customcase Softcase | 55000</option>
                    <option value="95000">Customcase Acrilic | 95000</option>
                </select>
            </div>
            <div class="col">
                <input type="number" class="form-control" name="qty" id="qty" placeholder="Quantity">
            </div>
        </div>
        <br/>
        <button class="btn btn-primary" id="pay-button">Bayar</button>
    </form>
</div>
</center>
<script type="text/javascript">

    $('#pay-button').click(function (event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");

        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var alamat = $('#alamat').val();
        var productName = $('#productName').val();
        var productPrice = $('#productPrice').val();
        var qty = $('#qty').val();

        $.ajax({
            type: 'POST',
            url: '<?=site_url()?>/snap/token',
            data : {
                fname: fname,
                lname: lname,
                phone: phone,
                email: email,
                alamat: alamat,
                productName: productName,
                productPrice: productPrice,
                qty: qty
            },
            cache: false,

            success: function(data) {
                //location = data;

                console.log('token = '+data);
                
                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type,data){
                $("#result-type").val(type);
                $("#result-data").val(JSON.stringify(data));
                //resultType.innerHTML = type;
                //resultData.innerHTML = JSON.stringify(data);
                }

                snap.pay(data, {
                
                onSuccess: function(result){
                    changeResult('success', result);
                    console.log(result.status_message);
                    console.log(result);
                    $("#payment-form").submit();
                },
                onPending: function(result){
                    changeResult('pending', result);
                    console.log(result.status_message);
                    $("#payment-form").submit();
                },
                onError: function(result){
                    changeResult('error', result);
                    console.log(result.status_message);
                    $("#payment-form").submit();
                }
                });
            }
        });
    });

</script>
</body>
</html>