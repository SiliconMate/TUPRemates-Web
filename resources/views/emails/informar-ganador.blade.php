<x-mail::message>
# Ganaste el {{ $producto->titulo }}!

Eres el ganador del producto {{ $producto->titulo }} en la subasta {{ $producto->subasta->nombre ?? ' ' }}.

Ponte en contacto con el vendedor para coordinar la entrega del producto y el pago.

Usuario Vendedor: {{ $producto->user->name }}

Email: {{ $producto->user->email }}

Teléfono: {{ $producto->user->telefono }}

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
