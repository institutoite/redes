<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socials</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

.cards-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 300px;
    transition: transform 0.3s, box-shadow 0.3s;
    text-decoration: none;
    color: inherit;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 16px rgba(0, 0, 0, 0.2);
}

.card-header {
    color: #fff;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header h2 {
    margin: 0;
    font-size: 1.5em;
}

.card-header i {
    font-size: 2em;
}

.card-body {
    padding: 20px;
    background-color: #f9f9f9;
}

.card-body p {
    margin: 0;
    font-size: 1.1em;
    color: #333;
}
a{
    color: #007bff;
    text-decoration: none;
    transition: color 0.3s;
}
#mapid{
    width: 100%;
    height: 400px;
}


    </style>
</head>
<body>
    <div class="container">
        <h1>Socials</h1>
        <div class="cards-container">
            @foreach ($socials as $social)
                <a href="{{ $social->link }}">
                    <div class="card">
                        <div class="card-header" style="background-color: {{ $social->color }};">
                            <h2>{{ $social->social }}</h2>
                            <i class="{{ $social->icon }}"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <h1>PRODUCTOS</h1>
        <div class="cards-container">
            @foreach ($products as $product)
               
                    <div class="card">
                        <div class="card-header" style="background-color:teal">
                            <h2>{{ $product->nombre }}</h2>
                        </div>
                        <div class="card-body">
                            <p>Bs. {{ $product->price }}</p>
                            <img src="{{ asset('storage/'.$product->imagen) }}" alt="Imagen">
                        </div>
                    </div>
                
            @endforeach
        </div>


        <div class="row">
            <div class="card-header" style="background-color:teal">
                Header
            </div>
            <div class="card-body">
                <div id="mapid">
            </div>
        </div>
    </div>
    
    
 
    </div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        var mymap = L.map('mapid').setView([-17.8016746, -63.1355868], 16);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mymap);
        L.marker([-17.8016746, -63.1355868]).addTo(mymap);
        
    </script>
</body>
</html>
