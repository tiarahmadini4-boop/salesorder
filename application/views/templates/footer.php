</div>
</div>
</div>

<script src="<?= base_url('assets/vendor/jquery/jquery.min.js');?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<script src="<?= base_url('assets/vendor/chart.js/Chart.min.js');?>"></script>
<script src="<?= base_url('assets/js/sb-admin-2.min.js');?>"></script>

<script>
    var ctx=document.getElementById("chartDashboard");
    var chart= new Chart(ctx,{
        type:'bar',
        data:{
            labels:['Kategori','Anggota'],
            datasets:[{
                label:'Jumlah Data',
                data:[
                    <?=$total_kategori;?>,
                    <?=$total_anggota;?>
                ],
                backgroundColor:[
                    '#4e73df',
                    '#1cc88a'
                ]
            }]
        },
        options:{
            responsive: true,
            scales:{
                yAxes:[{
                    ticks:{
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
</body>
</html>