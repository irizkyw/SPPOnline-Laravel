<table border="1px">
		<tr>
			<td width="80px"><img src="" alt="logo-sekolah" width="80px" /></td>
			<td>
				<table cellpadding="4">
					<tr>
						<td width="200px"><div class="lead">No kwitansi</td>
						<td><div class="value">:&nbsp;{{sprintf('%04d',$data->id)}}</div></td>
					</tr>
                    <tr>
						<td><div class="lead">Tanggal</div></td>
						<td><div class="value">:&nbsp;{{$data->tanggal_bayar}}</div></td>
					</tr>
                    <tr>
						<td><div class="lead">Untuk Bulan:</div></td>
						<td><div class="value">:&nbsp;{{$data->bulan_bayar}}</div></td>
					</tr>
					<tr>
						<td><div class="lead">Keterangan:</div></td>
						<td><div class="value">:&nbsp;{{$data->keterangan}}</div></td>
					</tr>
					<tr>
						<td><div class="lead">Rupiah</div></td>
						<td><div class="value-big">:&nbsp;Rp. {{number_format($data->jumlah_bayar,2)}}</div></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td><div class="lead">Petugas:</div></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>____________________________________________________</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
                        @foreach($petugas as $row)
						<td><div class="value">{{$row->name}}</div></td>
                        @endforeach
					</tr>
				</table>
			</td>
		</tr>
	</table>
    <br><br><br><br>
    <div class="cut">
        <table>
            <tr>
                <td>--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
            </tr>
        </table>
    </div>
                        