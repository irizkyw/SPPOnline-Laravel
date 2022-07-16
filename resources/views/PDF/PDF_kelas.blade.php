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
    <th>NISN</th>
    <th>NIS</th>
    <th>NAMA</th>
    <th>ALAMAT</th>
    <th>NO TELP</th>
  </tr>
  @foreach($data as $row)
  <tr>
    <td>{{$row->nisn}}</td>
    <td>{{$row->nis}}</td>
    <td>{{$row->nama}}</td>
    <td>{{$row->alamat}}</td>
    <td>{{$row->no_telp}}</td>
  </tr>
  @endforeach
</table>
</body>
</html>
