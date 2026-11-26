@extends('layouts.app')
@section('content')
    <h1 class="text-center mb-4">Cronómetro</h1>

    <div class="text-center mb-4">
        <div id="display" class="display-1 font-monospace mb-3">00:00.00</div>
        <button id="btn-iniciar" class="btn btn-success btn-lg">Iniciar</button>
        <button id="btn-vuelta" class="btn btn-secondary btn-lg" disabled>Vuelta</button>
        <button id="btn-reiniciar" class="btn btn-danger btn-lg">Reiniciar</button>
    </div>

    <table class="table table-striped w-75 mx-auto">
        <thead>
            <tr>
                <th>#</th>
                <th>Parcial</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="vueltas"></tbody>
    </table>

    <script>
        const CSRF = '{{ csrf_token() }}';
        const URL_VUELTAS = '{{ route('cronometro.storeVuelta') }}';

        let vueltas = @json($vueltas);
        let inicio = 0,
            acumulado = 0,
            timer = null,
            ultimaVuelta = 0;

        const display = document.getElementById('display');
        const btnIniciar = document.getElementById('btn-iniciar');
        const btnVuelta = document.getElementById('btn-vuelta');
        const btnReiniciar = document.getElementById('btn-reiniciar');
        const tbody = document.getElementById('vueltas');

        const pad = n => String(n).padStart(2, '0');

        function formatear(ms) {
            const m = Math.floor(ms / 60000);
            const s = Math.floor((ms % 60000) / 1000);
            const c = Math.floor((ms % 1000) / 10);
            return `${pad(m)}:${pad(s)}.${pad(c)}`;
        }

        const actual = () => acumulado + (timer ? performance.now() - inicio : 0);
        const pintar = () => display.textContent = formatear(actual());

        function renderVueltas() {
            tbody.innerHTML = vueltas
                .map((v, i) =>
                    `<tr><td>${i + 1}</td><td>${formatear(v.parcial_ms)}</td><td>${formatear(v.total_ms)}</td></tr>`)
                .reverse().join('');
        }

        btnIniciar.addEventListener('click', () => {
            if (timer) { // pausar
                acumulado += performance.now() - inicio;
                clearInterval(timer);
                timer = null;
                btnIniciar.textContent = 'Reanudar';
                btnIniciar.className = 'btn btn-success btn-lg';
                btnVuelta.disabled = true;
            } else { // iniciar o reanudar
                inicio = performance.now();
                timer = setInterval(pintar, 10);
                btnIniciar.textContent = 'Pausar';
                btnIniciar.className = 'btn btn-warning btn-lg';
                btnVuelta.disabled = false;
            }
        });

        btnVuelta.addEventListener('click', async () => {
            const total = Math.round(actual());
            const parcial = total - ultimaVuelta;
            ultimaVuelta = total;

            const r = await fetch(URL_VUELTAS, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF
                },
                body: JSON.stringify({
                    parcial_ms: parcial,
                    total_ms: total
                }),
            });
            vueltas.push(await r.json());
            renderVueltas();
        });

        btnReiniciar.addEventListener('click', async () => {
            clearInterval(timer);
            timer = null;
            acumulado = 0;
            ultimaVuelta = 0;
            pintar();
            btnIniciar.textContent = 'Iniciar';
            btnIniciar.className = 'btn btn-success btn-lg';
            btnVuelta.disabled = true;

            await fetch(URL_VUELTAS, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': CSRF,
                    'Accept': 'application/json'
                }
            });
            vueltas = [];
            renderVueltas();
        });

        renderVueltas();
    </script>
@endsection
