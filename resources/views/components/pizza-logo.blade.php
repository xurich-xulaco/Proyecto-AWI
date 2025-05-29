@props(['size' => 80, 'id' => null])

@php
    // Si no se pasa un ID, generamos uno único
    $id = $id ?? 'pizza-logo-' . uniqid();
@endphp

<div id="{{ $id }}"
     class="pizza-logo"
     style="width: {{ $size }}px; height: {{ $size }}px;">
    {{-- El canvas de three.js irá dentro de este div --}}
</div>

{{-- Pasamos el ID al script para que sepa dónde montar la escena --}}
<script type="module">
  import initPizzaLogo from '{{ asset('js/pizzaLogo.js') }}';
  // Delay para asegurar que three.js ya esté inicializado
  document.addEventListener('DOMContentLoaded', () => {
    initPizzaLogo('{{ $id }}', {{ $size }});
  });
</script>
