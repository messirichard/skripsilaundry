<section class='content'>
    <?php if ($this->session->userdata('message') != ''): ?>
        <div class="alert alert-danger" role="alert"><?=$this->session->userdata('message')?></div>
    <?php endif;?>

    <div class='box'>
        <div class='box-header'>
            <h2 style="margin-top:0px">Buat Transaksi </h2>
        </div>
        <div class='box-body'>
            <?php echo form_open('transactions/create_action'); ?>

            <div class="form-group">


                <!-- Get karyawan id from session -->
                <input type="hidden" class="form-control" name="employee_id"
                       value="<?=$this->ion_auth->user()->row()->id?>"/>
                <?php if (!$member_id): ?>
                    <label for="int">Nama <?php echo form_error('name') ?></label>
                    <input type="text" class="form-control" name="name" id="user_id" placeholder="Name"/>
                <?php else: ?>
                    <!-- Get member id from url segment-->
                    <input type="hidden" class="form-control" name="user_id" id="user_id" placeholder="User Id"
                           value="<?php echo $this->uri->segment(3); ?>"/>
                <?php endif;?>
            </div>

            <div class="form-group">
                    <label for="int">jumlah baju <?php echo form_error('laundry_qty') ?></label>
                    <input type="text" class="form-control" name="laundry_qty" id="laundry_qty" placeholder="Qty"/>
            </div>

            <div class="form-group">
                <label for="int">Paket Laundry <?php echo form_error('laundry_packet_name') ?></label>
                <select name="laundry_packet_id" id="laundry_packets" class="form-control">
                    <?php foreach ($laundry_packets as $packet): ?>
                        <?="<option value=$packet->laundry_packet_id > $packet->name</option>"?>
                    <?php endforeach;?>
                </select>
            </div>

            <?php if ($member_id): ?>
            <div class="form-group">
                <label for="">Metode Pembayaran: </label>
                <select name="pembayaran" id="" class="form-control">
                    <option value=1>Tunai</option>
                    <option value=2>Saldo</option>
                    <option value=3>Transfer</option>
                </select>
            </div>
            <?php else: ?>
            <div class="div form-group">
                <input type="hidden" name="pembayaran" value=1>
            </div>
            <?php endif;?>

            <div class="form-group">
                <label for="float">Harga <?php echo form_error('price') ?></label>
                <input type="text" class="form-control" id="price" disabled placeholder="Price"/>
            </div>

            <div class="form-group">
                <label for="float">Berat Baju <?php echo form_error('weight_total') ?></label>
                <input type="text" class="form-control" name="weight_total" id="weight_total" placeholder="Weight Total"
                       value="<?php echo $weight_total; ?>"/>
            </div>

            <div class="form-group">
                <label for="float">Total Harga</label>
                <h2 id="price_total"></h2>
                <input type="hidden" id="price_total_input" name="price" >
            </div>

            <button type="submit" class="btn btn-primary">Buat</button>
            <a href="<?php echo site_url('transactions') ?>" class="btn btn-default">Batal</a>
            <?php echo form_close() ?>
        </div>
    </div>
</section>

<script>
    var laundry_packets_id =  $("#laundry_packets").val();
    init();

    $("#laundry_packets").on('change', function () {
        laundry_packets_id =  $("#laundry_packets").val();
        getPrice(laundry_packets_id);
    });

    $("#weight_total").keyup(function () {
        setPriceTotal()
    })

    function getPrice(id)
    {
        $.get("http://laundry.skripsii.net/transactions/get_price/" +
id, function
(data) {
            $("#price").val(data.price);
            setPriceTotal()
        })
    }

    function setPriceTotal()
    {
        $("#price_total_input").val($("#price").val() * $("#weight_total").val());
        $("#price_total").html($("#price").val() * $("#weight_total").val());
    }

    function init()
    {
        getPrice(laundry_packets_id);
        setPriceTotal();
    }
</script>
