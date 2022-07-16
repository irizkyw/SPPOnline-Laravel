<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
<table>
  <tr>
    <th>tahun</th>
    <th>NOMINAL/BULAN</th>
    <th>JUMLAH PENDAPATAN SPP</th>
  </tr>
  @foreach($data as $row)
  <tr>
    <td>{{$row->tahun}}</td>
    <td>{{$row->nominal_bulan}}</td>
    <td>Rp. {{number_format($row->jumlah,2)}}</td>
  </tr>
  @endforeach
</table>
</body>
</html>
