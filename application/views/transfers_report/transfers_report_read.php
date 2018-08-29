<section class='content'>
    <div class='box'>
        <div class='box-header'>
            <h2 style="margin-top:0px">Detil Bukti Transfer</h2>
        </div>
        <div class='box-body'>
            <table class="table">
                <tr>
                    <td>Tipe Bukti</td>
                    <td><?php
                          switch ($type) {
                              case TOPUP_SALDO:
                                  echo "Top up Saldo";
                                  break;
                              case PEMBAYARAN_TRANSFER:
                                  echo "Bukti Transfer";
                                  break;
                          }
                        ?></td>
                </tr>
                <tr>
                    <td>Nama Pelanggan</td>
                    <td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <td>Transaction Id</td>
                    <td><a href="<?php echo site_url('/transactions/read/'.$transaction_id); ?>"><?php echo $transaction_id; ?></a></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td>
                        <a href="<?php echo base_url($image) ?>" data-lightbox="<?php echo $transaction_id?>" alt="">
                            <img src="<?php echo base_url($image)?>" height="150" width="auto" alt="">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><?php echo $status; ?></td>
                </tr>
                <tr>
                    <td>Created On</td>
                    <td><?php echo $created_on; ?></td>
                </tr>

                <tr>
                    <td></td>
                    <td><a href="<?php echo site_url('transfers_report') ?>" class="btn btn-default">Cancel</a></td>
                </tr>
            </table>
        </div>
    </div>
</section>