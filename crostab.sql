select provinsi
, sum(case when tahun='2015' then jumlah end) tahun2015
, sum(case when tahun='2016' then jumlah end) tahun2016
, sum(case when tahun='2017' then jumlah end) tahun2017
, sum(case when tahun='2018' then jumlah end) tahun2018
, sum(case when tahun='2019' then jumlah end) tahun2019
, sum(case when tahun='2020' then jumlah end) tahun2020
, sum(case when tahun='2021' then jumlah end) tahun2121
, sum(case when tahun='2022' then jumlah end) tahun2022
, sum(case when tahun='2023' then jumlah end) tahun2023

from view_jumlah
group by provinsi ;

select tahun
, sum(case when nama_ujian='UTG-1' then jumlah end) UTG1
, sum(case when nama_ujian='USM-1' then jumlah end) USM1
, sum(case when nama_ujian='JPPA-N' then jumlah end) JPPAN
, sum(case when nama_ujian='JPPA-U' then jumlah end) JPPAU
, sum(case when nama_ujian='USM-2' then jumlah end) USM2
, sum(case when nama_ujian='UTG-2' then jumlah end) UTG2
, sum(case when nama_ujian='UTG-3' then jumlah end) UTG3
, sum(case when nama_ujian='CBT' then jumlah end) CBT
, sum(case when nama_ujian='Kemitraan' then jumlah end) Kemitraan

from total_ujian
group by nama_ujian ;