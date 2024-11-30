<!DOCTYPE html>
<html>
<head>
	<title>Factura</title>
	<style type="text/css">
		*{
			box-sizing: border-box;
			-webkit-user-select: none; /* Chrome, Opera, Safari */
			-moz-user-select: none; /* Firefox 2+ */
			-ms-user-select: none; /* IE 10+ */
			user-select: none; /* Standard syntax */
		}
		.bill-container{
			width: 750px;
			position: absolute;
			left:0;
			right: 0;
			margin: auto;
			border-collapse: collapse;
			font-family: sans-serif;
			font-size: 13px;
		}

		.bill-emitter-row td{
			width: 50%;
			border-bottom: 1px solid; 
			padding-top: 10px;
			padding-left: 10px;
			vertical-align: top;
		}
		.bill-emitter-row{
			position: relative;
		}
		.bill-emitter-row td:nth-child(2){
			padding-left: 60px;
		}
		.bill-emitter-row td:nth-child(1){
			padding-right: 60px;
		}

		.bill-type{
			border: 1px solid;
			border-top: 1px solid; 
			border-bottom: 1px solid; 
			margin-right: -30px;
			background: white;
			width: 60px;
			height: 50px;
			position: absolute;
			left: 0;
			right: 0;
			top: -1px;
			margin: auto;
			text-align: center;
			font-size: 40px;
			font-weight: 600;
		}
		.text-lg{
			font-size: 30px;
		}
		.text-center{
			text-align: center;
		}

		.col-2{
			width: 16.66666667%;
			float: left;
		}
		.col-3{
			width: 25%;
			float: left;
		}
		.col-4{
			width: 33.3333333%;
			float: left;
		}
		.col-5{
			width: 41.66666667%;
			float: left;
		}
		.col-6{
			width: 50%;
			float: left;
		}
		.col-8{
			width: 66.66666667%;
			float: left;
		}
		.col-10{
			width: 83.33333333%;
			float: left;
		}
		.row{
			overflow: hidden;
		}

		.margin-b-0{
			margin-bottom: 0px;
		}

		.bill-row td{
			padding-top: 5px
		}

		.bill-row td > div{
			border-top: 1px solid; 
			border-bottom: 1px solid; 
			margin: 0 -1px 0 -2px;
			padding: 0 10px 13px 10px;
		}
		.row-details table {
			border-collapse: collapse;
			width: 100%;
		}
		.row-details td > div, .row-qrcode td > div{
			border: 0;
			margin: 0 -1px 0 -2px;
			padding: 0;
		}
		.row-details table td{
			padding: 5px;
		}
		.row-details table tr:nth-child(1){
			border-top: 1px solid; 
			border-bottom: 1px solid; 
			background: #c0c0c0;
			font-weight: bold;
			text-align: center;
		}
		.row-details table tr +  tr{
			border-top: 1px solid #c0c0c0; 
			
		}
		.text-right{
			text-align: right;
		}

		.margin-b-10 {
			margin-bottom: 10px;
		}

		.total-row td > div{
			border-width: 2px;
		}

		.row-qrcode td{
			padding: 10px;
		}		

		#qrcode {
			width: 50%
		}
	</style>
</head>
<body>
	<table class="bill-container">
		<tr class="bill-emitter-row">
			<td>
				<div class="bill-type">B</div>
				<div class="text-lg text-center">
					TUP Remates S.R.L.
				</div>
				<p><strong>Razón social:</strong> TUP Remates S.R.L. </p>
				<p><strong>Domicilio Comercial:</strong> Calle Falsa 123</p>
				<p><strong>Condición Frente al IVA:</strong> Responsable Inscripto</p>
			</td>
			<td>
				<div>
					<div class="text-lg">Factura</div>
					<div class="row">
						<p class="margin-b-0"><strong>Punto de Venta: 0001</strong></p>
						<p class="margin-b-0"><strong>Comp. Nro: 000000032</strong></p>
					</div>
					<p><strong>Fecha de Emisión:</strong> 30/11/2024</p>
					<p><strong>CUIT:</strong> 30-12345678-9</p>
					<p><strong>Ingresos Brutos:</strong> 12345432</p>
					<p><strong>Fecha de Inicio de Actividades:</strong> 01/01/2020</p>
				</div>
			</td>
		</tr>
		<tr class="bill-row">
			<td colspan="2">
				<div class="row">
					<p class="margin-b-0"><strong>Período Facturado Desde:</strong> 01/11/2024</p>
					<p class="margin-b-0"><strong>Hasta:</strong> 30/11/2024</p>
				</div>
			</td>
		</tr>
		<tr class="bill-row">
			<td colspan="2">
				<div>
                    @if ($vendedor->cuit)
                        <p><strong>CUIL/CUIT:</strong> {{ $vendedor->cuit }}</p>
                        <p><strong>Apellido y Nombre / Razón social:</strong> {{ $vendedor->razon_social }}</p>
                    @else
                        <p><strong>CUIL/CUIT:</strong> {{ $vendedor->numero_documento}}</p>
                        <p><strong>Apellido y Nombre / Razón social:</strong> {{ $vendedor->nombre }} {{ $vendedor->apellido }}</p>
                    @endif
					<p><strong>Condición Frente al IVA:</strong> Consumidor Final</p>
					<p><strong>Domicilio:</strong> -</p>
					<p><strong>Condición de Venta:</strong> -</p>
				</div>
			</td>
		</tr>
		<tr class="bill-row row-details">
			<td colspan="2">
				<table>
					<tr>
						<td>Código</td>
						<td>Producto / Servicio</td>
						<td>Cantidad</td>
						<td>Precio Unit.</td>
						<td>Subtotal</td>
					</tr>
					<tr>
						<td>001</td>
						<td>Servicio de Intermediación por venta de {{ $producto->titulo }}</td>
						<td>1</td>
						<td>{{ $precioVendido * 0.10 }}</td>
						<td>{{ $precioVendido * 0.10 }}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="bill-row total-row">
			<td colspan="2">
				<div>
					<div class="text-right">
						<p><strong>Subtotal: $</strong> {{ $precioVendido * 0.10 }} </p>
						<p><strong>Importe IVA (21%): $</strong> {{ ($precioVendido * 0.1) * 0.21 }}</p>
						<p><strong>Importe Total: $</strong> {{ $precioVendido * 0.10 + ($precioVendido * 0.1) * 0.21 }}</p>
					</div>
				</div>
			</td>
		</tr>
		<tr class="bill-row">
			<td>
				<div>
					<div class="row">
                        qr_code
                    </div>
				</div>
			</td>
			<td>
				<div class="text-right">
					<p><strong>CAE Nº:</strong> 12345678901234</p>
					<p><strong>Fecha de Vto. de CAE:</strong> 15/12/2024</p>
				</div>
			</td>
		</tr>
	</table>
</body>
</html>
