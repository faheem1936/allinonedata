<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {

    header("Content-Type: application/json; charset=UTF-8");

    $service = $_POST['service'] ?? '';
    $number  = $_POST['number'] ?? '';

    if (empty($service) || empty($number)) {
        echo json_encode(["error"=>"Missing parameters"]);
        exit;
    }

    // 🔥 ALL YOUR ORIGINAL SERVICES ADDED
    $services = [

        "sim-data" => ["url"=>"https://mahisite.xyz/user/API/search.php","userid"=>"12"],
        "patient-records" => ["url"=>"https://mahisite.xyz/user/API/api-patient.php","userid"=>"12"],
        "fir-check-punjab" => ["url"=>"https://mahisite.xyz/user/API/api-fircheckpunjab.php","userid"=>"12"],
        "cro-punjab" => ["url"=>"https://mahisite.xyz/user/API/api-cropunjab.php","userid"=>"12"],
        "cro-sindh" => ["url"=>"https://mahisite.xyz/user/API/api-crosindh.php","userid"=>"12"],
        "cnic-to-fir" => ["url"=>"https://mahisite.xyz/user/API/cnic-to-fir.php","userid"=>"12"],
        "sindh-employees" => ["url"=>"https://mahisite.xyz/user/API/api-sindhemployees.php","userid"=>"12"],
        "punjab-land" => ["url"=>"https://mahisite.xyz/user/API/api-punjabland.php","userid"=>"12"],
        "ajk-vehicle" => ["url"=>"https://mahisite.xyz/user/API/api-ajkvehicle.php","userid"=>"12"],
        "domicile" => ["url"=>"https://mahisite.xyz/user/API/api-domicile.php","userid"=>"12"],
        "kashmir-tree" => ["url"=>"https://mahisite.xyz/user/API/api-kashmirtree.php","userid"=>"12"],

        "fbr" => ["url"=>"https://khoji2.online/user/API/api-fbr.php","userid"=>"150"],
        "one-click" => ["url"=>"https://khoji2.online/user/API/api-oneclick.php","userid"=>"150"],
        "all-in-one-details" => ["url"=>"https://khoji2.online/user/API/api-oneclick-cnic.php","userid"=>"150"],
    ];

    if (!isset($services[$service])) {
        echo json_encode(["error"=>"Invalid service"]);
        exit;
    }

    $api = $services[$service];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api['url']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        "number"=>$number,
        "userid"=>$api['userid']
    ]));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo json_encode(["error"=>"Server Error or No Internet"]);
    } else {
        echo json_encode(["success"=>true,"data"=>$response]);
    }

    curl_close($ch);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Faheem Tracker</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
body {
    background: linear-gradient(to bottom right, #0f172a, #581c87, #0f172a);
    min-height: 100vh;
}
</style>
</head>
<body class="text-white">

<div class="max-w-7xl mx-auto py-10 px-6">

<h1 class="text-4xl font-bold text-center mb-10 text-purple-400">
Faheem Tracker
</h1>

<!-- SEARCH -->
<div id="searchSection">
<input type="text" id="searchInput"
class="w-full p-4 rounded-xl bg-slate-800 border border-slate-600 mb-3"
placeholder="Enter CNIC">

<p class="text-center text-sm text-slate-300 mb-6">
Wait a few seconds, details are being searched...
</p>
</div>

<!-- BUTTON GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-8">

<button onclick="searchService('sim-data')" class="bg-blue-600 p-4 rounded-xl">📱 SIM Data</button>
<button onclick="searchService('patient-records')" class="bg-green-600 p-4 rounded-xl">🏥 Patient Records</button>
<button onclick="searchService('fir-check-punjab')" class="bg-yellow-600 p-4 rounded-xl">📋 FIR Check Punjab</button>
<button onclick="searchService('cro-punjab')" class="bg-purple-600 p-4 rounded-xl">📄 CRO Punjab</button>
<button onclick="searchService('cro-sindh')" class="bg-pink-600 p-4 rounded-xl">📃 CRO Sindh</button>
<button onclick="searchService('cnic-to-fir')" class="bg-indigo-600 p-4 rounded-xl">🔍 CNIC to FIR</button>
<button onclick="searchService('sindh-employees')" class="bg-teal-600 p-4 rounded-xl">👥 Sindh Employees</button>
<button onclick="searchService('punjab-land')" class="bg-orange-600 p-4 rounded-xl">🏞️ Punjab Land</button>
<button onclick="searchService('ajk-vehicle')" class="bg-red-600 p-4 rounded-xl">🚕 AJK Vehicle</button>
<button onclick="searchService('domicile')" class="bg-cyan-600 p-4 rounded-xl">🏠 Domicile</button>
<button onclick="searchService('kashmir-tree')" class="bg-emerald-600 p-4 rounded-xl">🌳 Kashmir Tree</button>
<button onclick="searchService('fbr')" class="bg-gray-600 p-4 rounded-xl">💼 FBR</button>
<button onclick="searchService('one-click')" class="bg-violet-600 p-4 rounded-xl">⚡ All in One Data</button>
<button onclick="searchService('all-in-one-details')" class="bg-purple-700 p-4 rounded-xl">🔎 All in One Details</button>

<!-- SPECIAL IFRAME BUTTONS -->
<button onclick="openIframe('https://p01--faheem-tracker2--89q4vtp4hz4m.code.run/tracker.php')" 
class="bg-gradient-to-r from-pink-500 to-purple-600 p-4 rounded-xl shadow-lg">
🎯 Faheem Tracker
</button>

<button onclick="openIframe('https://p01--ptcl-data--89q4vtp4hz4m.code.run/')" 
class="bg-gradient-to-r from-blue-500 to-cyan-500 p-4 rounded-xl shadow-lg">
📡 PTCL Data
</button>
    <button onclick="openIframe('https://punjab--e-challan-check--89q4vtp4hz4m.code.run/echallan.php')" 
class="bg-gradient-to-r from-pink-500 to-purple-600 p-4 rounded-xl shadow-lg">
🚗 E-Challan-Punjab
</button>
   <button onclick="openIframe('https://punjab--vehicle-criminal-record--89q4vtp4hz4m.code.run/vehicle.php')" 
class="bg-gradient-to-r from-blue-500 to-cyan-500 p-4 rounded-xl shadow-lg">
🚗 Criminal Vehicle Record
</button>

</div>

<!-- RESULT -->
<div class="bg-white rounded-xl overflow-hidden shadow-inner">
<iframe id="resultFrame" class="w-full h-[600px] border-0"></iframe>
</div>

</div>

<script>

function searchService(service){

const number=document.getElementById("searchInput").value.trim();
if(!number){ alert("Enter CNIC first"); return; }

const iframe=document.getElementById("resultFrame");
const doc=iframe.contentDocument || iframe.contentWindow.document;

doc.open();
doc.write("<h2 style='text-align:center;padding:40px'>Loading... Please wait</h2>");
doc.close();

const formData=new FormData();
formData.append("ajax","1");
formData.append("service",service);
formData.append("number",number);

fetch("",{method:"POST",body:formData})
.then(res=>res.json())
.then(data=>{
const doc=iframe.contentDocument || iframe.contentWindow.document;
doc.open();
if(data.error){
doc.write("<h2 style='color:red;text-align:center'>"+data.error+"</h2>");
}else{
doc.write(data.data);
}
doc.close();
});
}

function openIframe(url){
document.getElementById("searchSection").style.display="none";
document.getElementById("resultFrame").src=url;
}

</script>

</body>
</html>
