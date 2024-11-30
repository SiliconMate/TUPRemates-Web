<x-mail::message>
# Ganaste el {{ $producto->titulo }}!

Eres el ganador del producto {{ $producto->titulo }} en la subasta {{ $producto->subasta->nombre ?? ' ' }}.

Ponte en contacto con el vendedor para coordinar la entrega del producto y el pago.

Usuario Vendedor: {{ $producto->solicitado_por->name }}

Email: {{ $producto->solicitado_por->email }}

Teléfono: {{ $producto->solicitado_por->telefono }}

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
