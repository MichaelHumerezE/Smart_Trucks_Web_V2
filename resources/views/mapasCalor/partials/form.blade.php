@section('css')
    <style>
        /* Estilos para la barra de degradado */
        .legend {
            background: linear-gradient(to right, red, yellow, green);
            width: 100%;
            /* Ancho de la barra */
            height: 20px;
            /* Alto de la barra */
            margin: 10px;
        }

        /* Estilos para los valores máximos y mínimos */
        .legend-values {
            display: flex;
            justify-content: space-between;
            margin: 0 10px;
        }
    </style>
@endsection

@csrf
<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="date" placeholder="fechaIni" class="form-control" name="fechaIni" value="">
            <label>Fecha de Inicio</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="date" placeholder="fechaFin" class="form-control" name="fechaFin" value="">
            <label>Fecha de Finalización</label>
        </div>
    </div>
    <Button class="btn btn-primary" form="create">
        <i class="fas fa-plus"></i> Enviar
    </Button>
    <div class="col-12">
        <div class="legend">
        </div>
        <div class="legend-values">
            <span>{{ $rutas[0]->cantidad }} Kgs</span>
            <span>0 Kgs</span>
        </div>
    </div>
</div>
<br>
<!--------------------------------------------------------------------------------->
<div id="map" style="width: 100%; height: 600px;"></div>

<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap&v=weekly&libraries=visualization"
    defer></script>

<script>
    let markers = [];

    function initMap() {
        const map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: -17.7799086353198,
                lng: -63.18265591059412
            },
            zoom: 14,
            clickableIcons: false
        });

        const points = [
            <?php
            // Supongamos que tienes un arreglo de objetos stdClass llamado $sucursales
            foreach ($rutas as $ruta) {
                $puntos = json_decode($ruta->coordenadas);
                foreach ($puntos as $punto) {
                    echo '{ location: new google.maps.LatLng(' . $punto->lat . ', ' . $punto->lng . '), weight: ' . $ruta->cantidad . '},';
                }
            }
            ?>
        ];

        var heatmapOptions = {
            radius: 15, // Radio de los puntos de calor
        };

        var heatmap = new google.maps.visualization.HeatmapLayer({
            data: points,
            options: heatmapOptions
        });

        heatmap.setMap(map);

        console.log(points);
    }
</script>
