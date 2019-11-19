ERROR - 2019-11-14 06:55:53 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-14 06:56:02 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-14 06:56:34 --> kadieu2
ERROR - 2019-11-14 07:00:28 --> Query error: Unknown column 'a.bidang' in 'on clause' - Invalid query: 		
		select unitup,unitap,nama namaap,namaup,count(target) target,count(pencapaian) pencapaian
from (select a.unitup,a.unitap,d.nama,a.nama namaup,b.unitup u2,b.target,b.pencapaian from tb_unitup a
left join tb_lead_measure b
on a.unitup = b.unitup and DATE_FORMAT(tanggal, '%Y-%m-%d')='2019-11-13'   and a.bidang='NIAGA'
left join tb_unitap d
on a.unitap=d.unitap) c

group by unitup
order by unitap asc,unitup asc
ERROR - 2019-11-14 07:00:28 --> Severity: error --> Exception: Call to a member function result() on boolean C:\xampp7\htdocs\dash_djb\application\models\Niaga_model.php 53
ERROR - 2019-11-14 07:15:07 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-14 07:15:11 --> kadieu2
ERROR - 2019-11-14 07:18:07 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-14 07:18:09 --> kadieu2
