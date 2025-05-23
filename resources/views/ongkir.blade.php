<!DOCTYPE html> 
<html> 
 
<head> 
    <title>Cek Ongkir</title> 
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
</head> 
 
<body> 
    <div class="w-50">
    <form id="ongkirForm" method="post"> 
        @csrf
        <label for="origin">Asal Kota</label>
        <select name="origin" id="origin" class="form-control"> 
            <option value="">Pilih Provinsi</option> 
        </select>
        <label for="destination">Asal Kota</label>
        <select name="destination" id="destination" class="form-control"> 
            <option value="">Pilih Kota</option> 
        </select>
        <label for="weight">Berat Paket</label>
        <input type="number" name="weight" id="weight" placeholder="Berat (gram)" class="form-control">
        
        <label for="courier">Kurir</label>
        <select name="courier" id="courier"> 
            <option value="">Pilih Kurir</option> 
            <option value="jne">JNE</option> 
            <option value="tiki">TIKI</option> 
            <option value="pos">POS Indonesia</option> 
        </select> 
        <button type="submit" name="Cek Ongkir" class="btn-btn-primary">Cek Ongkir</button> 
    </form> 
 
    
    
</body> 
 
</html>