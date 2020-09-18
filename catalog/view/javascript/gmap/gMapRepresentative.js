

 var mapCenter = new google.maps.LatLng(30.64463782485651, 8.8017578125);
  
function initialize() {
    var mapProp = {
        center: mapCenter,
        zoom: 2,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);



    /****************************************************************************/
    var ukPos = new google.maps.LatLng(53.64463782485651, -1.8017578125);
    var uk = new google.maps.Marker({
        position: ukPos,
        title: 'Click to zoom',
        icon: 'catalog/view/javascript/gmap/Flags/u/uk.png'
    });
    uk.setMap(map);     
    google.maps.event.addListener(uk, 'click', function () {         
        window.location.href = "?route=customer/customer&country_id=222";
    });


    /**************************Ireland   ************************************/
    var irlandPos = new google.maps.LatLng(52.802761415419674, -8.1298828125);
    var irland = new google.maps.Marker({
        position: irlandPos,
        icon: 'catalog/view/javascript/gmap/Flags/i/Ireland.png'
    });
    irland.setMap(map);
    google.maps.event.addListener(irland, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=103";
    });
    /*****************************************************************************/

    /****************************************************************************/
    var germanyPos = new google.maps.LatLng(50.79204706440684, 10.01953125);
    var germany = new google.maps.Marker({
        position: germanyPos,
        icon: 'catalog/view/javascript/gmap/Flags/g/Germany.png'
    });
    germany.setMap(map);
    google.maps.event.addListener(germany, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=81";
    });
    /*****************************************************************************/
    var russiaPos = new google.maps.LatLng(63.54855223203644, 88.9453125);
    var russia = new google.maps.Marker({
        position: russiaPos,
        icon: 'catalog/view/javascript/gmap/Flags/r/Russia.png'
    });
    russia.setMap(map);
    google.maps.event.addListener(russia, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=176";
    });
    /*****************************************************************************/
    var francePos = new google.maps.LatLng(46.70973594407157, 2.98828125);
    var france = new google.maps.Marker({
        position: francePos,
        icon: 'catalog/view/javascript/gmap/Flags/f/France.png'
    });
    france.setMap(map);
    google.maps.event.addListener(france, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=74";
    });
    /*****************************************************************************/
    var spainPos = new google.maps.LatLng(39.13006024213511, -3.9990234375);
    var spain = new google.maps.Marker({
        position: spainPos,
        icon: 'catalog/view/javascript/gmap/Flags/s/Spain.png'
    });
    spain.setMap(map);
    google.maps.event.addListener(spain, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=195";
    });
    /*****************************************************************************/
    var portogalPos = new google.maps.LatLng(39.87601941962116, -8.3056640625);
    var portogal = new google.maps.Marker({
        position: portogalPos,
        icon: 'catalog/view/javascript/gmap/Flags/p/Portugal.png'
    });
    portogal.setMap(map);
    google.maps.event.addListener(portogal, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=171";
    });
    /*****************************************************************************/
    var italyPos = new google.maps.LatLng(42.779275360241904, 11.77734375);
    var italy = new google.maps.Marker({
        position: italyPos,
        icon: 'catalog/view/javascript/gmap/Flags/i/Italy.png'
    });
    italy.setMap(map);
    google.maps.event.addListener(italy, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=105";
    });
    /*****************************************************************************/
    var maltaPos = new google.maps.LatLng(35.85343961959182, 14.4085693359375);
    var malta = new google.maps.Marker({
        position: maltaPos,
        icon: 'catalog/view/javascript/gmap/Flags/m/Malta.png'
    });
    malta.setMap(map);
    google.maps.event.addListener(malta, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=132";
    });
    /*****************************************************************************/
    var switzerlandPos = new google.maps.LatLng(46.61926103617151, 8.1298828125);
    var switzerland = new google.maps.Marker({
        position: switzerlandPos,
        icon: 'catalog/view/javascript/gmap/Flags/s/Switzerland.png'
    });
    switzerland.setMap(map);
    google.maps.event.addListener(switzerland, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=204";
    });
    /*****************************************************************************/
    var austriaPos = new google.maps.LatLng(47.26432008025478, 13.88671875);
    var austria = new google.maps.Marker({
        position: austriaPos,
        icon: 'catalog/view/javascript/gmap/Flags/a/Austria.png'
    });
    austria.setMap(map);
    google.maps.event.addListener(austria, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=14";
    });
    /*****************************************************************************/
    var czechPos = new google.maps.LatLng(49.55372551347579, 15.2490234375);
    var czech = new google.maps.Marker({
        position: czechPos,
        icon: 'catalog/view/javascript/gmap/Flags/c/Czech.png'
    });
    czech.setMap(map);
    google.maps.event.addListener(czech, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=56";
    });
    /*****************************************************************************/
    var polandPos = new google.maps.LatLng(52.10650519075632, 18.78662109375);
    var poland = new google.maps.Marker({
        position: polandPos,
        icon: 'catalog/view/javascript/gmap/Flags/p/Poland.png'
    });
    poland.setMap(map);
    google.maps.event.addListener(poland, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=170";
    });
    /*****************************************************************************/
    var belgiumPos = new google.maps.LatLng(50.499452103967734, 4.3505859375);
    var belgium = new google.maps.Marker({
        position: belgiumPos,
        icon: 'catalog/view/javascript/gmap/Flags/b/Belgium.png'
    });
    belgium.setMap(map);
    google.maps.event.addListener(belgium, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=21";
    });
    /*****************************************************************************/
    var netherlandsPos = new google.maps.LatLng(51.944264879028765, 5.185546875);
    var netherlands = new google.maps.Marker({
        position: netherlandsPos,
        icon: 'catalog/view/javascript/gmap/Flags/n/Netherlands.png'
    });
    netherlands.setMap(map);
    google.maps.event.addListener(netherlands, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=150";
    });
    /*****************************************************************************/
    var denmarkPos = new google.maps.LatLng(55.51619215717893, 10.008544921875);
    var denmark = new google.maps.Marker({
        position: denmarkPos,
        icon: 'catalog/view/javascript/gmap/Flags/d/Denmark.png'
    });
    denmark.setMap(map);
    google.maps.event.addListener(denmark, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=57";
    });
    /*****************************************************************************/
    var swedenPos = new google.maps.LatLng(62.71446210149774, 16.611328125);
    var sweden = new google.maps.Marker({
        position: swedenPos,
        icon: 'catalog/view/javascript/gmap/Flags/s/Sweden.png'
    });
    sweden.setMap(map);
    google.maps.event.addListener(sweden, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=203";
    });
    /*****************************************************************************/
    var norwayPos = new google.maps.LatLng(61.66902436927203, 9.0087890625);
    var norway = new google.maps.Marker({
        position: norwayPos,
        icon: 'catalog/view/javascript/gmap/Flags/n/Norway.png'
    });
    norway.setMap(map);
    google.maps.event.addListener(norway, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=160";
    });
    /*****************************************************************************/
    var finlandPos = new google.maps.LatLng(62.431074232920906, 25.48828125);
    var finland = new google.maps.Marker({
        position: finlandPos,
        icon: 'catalog/view/javascript/gmap/Flags/f/Finland.png'
    });
    finland.setMap(map);
    google.maps.event.addListener(finland, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=72";
    });
    /*****************************************************************************/
    var estoniaPos = new google.maps.LatLng(58.539594766640484, 25.576171875);
    var estonia = new google.maps.Marker({
        position: estoniaPos,
        icon: 'catalog/view/javascript/gmap/Flags/n/Norway.png'
    });
    estonia.setMap(map);
    google.maps.event.addListener(estonia, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=67";
    });
    /*****************************************************************************/
    var estoniaPos = new google.maps.LatLng(58.539594766640484, 25.576171875);
    var estonia = new google.maps.Marker({
        position: estoniaPos,
        icon: 'catalog/view/javascript/gmap/Flags/e/Estonia.png'
    });
    estonia.setMap(map);
    google.maps.event.addListener(estonia, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=67";
    });
    /*****************************************************************************/
    var latviaPos = new google.maps.LatLng(56.78884524518923, 25.400390625);
    var latvia = new google.maps.Marker({
        position: latviaPos,
        icon: 'catalog/view/javascript/gmap/Flags/l/Latvia.png'
    });
    latvia.setMap(map);
    google.maps.event.addListener(latvia, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=117";
    });
    /*****************************************************************************/
    var lithuaniaPos = new google.maps.LatLng(55.26659815231191, 23.653564453125);
    var lithuania = new google.maps.Marker({
        position: lithuaniaPos,
        icon: 'catalog/view/javascript/gmap/Flags/l/Lithuania.png'
    });
    lithuania.setMap(map);
    google.maps.event.addListener(lithuania, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=123";
    });
    /*****************************************************************************/
    var belarusPos = new google.maps.LatLng(52.93539665862318, 27.59765625);
    var belarus = new google.maps.Marker({
        position: belarusPos,
        icon: 'catalog/view/javascript/gmap/Flags/b/Belarus.png'
    });
    belarus.setMap(map);
    google.maps.event.addListener(belarus, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=20";
    });
    /*****************************************************************************/
    var ukrainePos = new google.maps.LatLng(48.48748647988415, 31.5087890625);
    var ukraine = new google.maps.Marker({
        position: ukrainePos,
        icon: 'catalog/view/javascript/gmap/Flags/u/Ukraine.png'
    });
    ukraine.setMap(map);
    google.maps.event.addListener(ukraine, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=220";
    });
    /*****************************************************************************/
    var moldovaPos = new google.maps.LatLng(47.249406957888446, 28.388671875);
    var moldova = new google.maps.Marker({
        position: moldovaPos,
        icon: 'catalog/view/javascript/gmap/Flags/m/Moldova.png'
    });
    moldova.setMap(map);
    google.maps.event.addListener(moldova, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=140";
    });
    /*****************************************************************************/
    var romaniaPos = new google.maps.LatLng(45.44471679159555, 24.609375);
    var romania = new google.maps.Marker({
        position: romaniaPos,
        icon: 'catalog/view/javascript/gmap/Flags/r/Romania.png'
    });
    romania.setMap(map);
    google.maps.event.addListener(romania, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=175";
    });
    /*****************************************************************************/
    var serbiaPos = new google.maps.LatLng(43.89789239125797, 20.6982421875);
    var serbia = new google.maps.Marker({
        position: serbiaPos,
        icon: 'catalog/view/javascript/gmap/Flags/s/Serbia.png'
    });
    serbia.setMap(map);
    google.maps.event.addListener(serbia, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=243";
    });
    /*****************************************************************************/
    var bosniaPos = new google.maps.LatLng(44.11914151643737, 17.666015625);
    var bosnia = new google.maps.Marker({
        position: bosniaPos,
        icon: 'catalog/view/javascript/gmap/Flags/b/Bosnia.png'
    });
    bosnia.setMap(map);
    google.maps.event.addListener(bosnia, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=27";
    });
    /*****************************************************************************/
    var croatiaPos = new google.maps.LatLng(44.96479793033104, 15.3369140625);
    var croatia = new google.maps.Marker({
        position: croatiaPos,
        icon: 'catalog/view/javascript/gmap/Flags/c/Croatia.png'
    });
    croatia.setMap(map);
    google.maps.event.addListener(croatia, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=53";
    });
    /*****************************************************************************/
    var sloveniaPos = new google.maps.LatLng(45.98932892799952, 14.52392578125);
    var slovenia = new google.maps.Marker({
        position: sloveniaPos,
        icon: 'catalog/view/javascript/gmap/Flags/s/Slovenia.png'
    });
    slovenia.setMap(map);
    google.maps.event.addListener(slovenia, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=190";
    });
    /*****************************************************************************/
    var montenegroPos = new google.maps.LatLng(42.75507954507213, 19.22607421875);
    var montenegro = new google.maps.Marker({
        position: montenegroPos,
        icon: 'catalog/view/javascript/gmap/Flags/m/Montenegro.png'
    });
    montenegro.setMap(map);
    google.maps.event.addListener(montenegro, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=242";
    });
    /*****************************************************************************/
    var albaniaPos = new google.maps.LatLng(40.91351257612757, 19.9951171875);
    var albania = new google.maps.Marker({
        position: albaniaPos,
        icon: 'catalog/view/javascript/gmap/Flags/a/Albania.png'
    });
    albania.setMap(map);
    google.maps.event.addListener(albania, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=2";
    });
    /*****************************************************************************/
    var macedoniaPos = new google.maps.LatLng(41.44272637767212, 21.6650390625);
    var macedonia = new google.maps.Marker({
        position: macedoniaPos,
        icon: 'catalog/view/javascript/gmap/Flags/m/Macedonia.png'
    });
    macedonia.setMap(map);
    google.maps.event.addListener(macedonia, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=126";
    });
    /*****************************************************************************/
    var bulgariaPos = new google.maps.LatLng(42.22851735620852, 25.224609375);
    var bulgaria = new google.maps.Marker({
        position: bulgariaPos,
        icon: 'catalog/view/javascript/gmap/Flags/b/Bulgaria.png'
    });
    bulgaria.setMap(map);
    google.maps.event.addListener(bulgaria, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=33";
    });
    /*****************************************************************************/
    var greecePos = new google.maps.LatLng(38.8225909761771, 22.1923828125);
    var greece = new google.maps.Marker({
        position: greecePos,
        icon: 'catalog/view/javascript/gmap/Flags/g/Greece.png'
    });
    greece.setMap(map);
    google.maps.event.addListener(greece, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=84";
    });
    /*****************************************************************************/
    var turkeyPos = new google.maps.LatLng(38.548165423046584, 34.3212890625);
    var turkey = new google.maps.Marker({
        position: turkeyPos,
        icon: 'catalog/view/javascript/gmap/Flags/t/Turkey.png'
    });
    turkey.setMap(map);
    google.maps.event.addListener(turkey, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=215";
    });
    /*****************************************************************************/
    var hungaryPos = new google.maps.LatLng(46.81509864599243, 19.31396484375);
    var hungary = new google.maps.Marker({
        position: hungaryPos,
        icon: 'catalog/view/javascript/gmap/Flags/h/Hungary.png'
    });
    hungary.setMap(map);
    google.maps.event.addListener(hungary, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=97";
    });
    /*****************************************************************************/
    var slovakiaPos = new google.maps.LatLng(48.574789910928864, 19.599609375);
    var slovakia = new google.maps.Marker({
        position: slovakiaPos,
        icon: 'catalog/view/javascript/gmap/Flags/s/Slovakia.png'
    });
    slovakia.setMap(map);
    google.maps.event.addListener(slovakia, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=189";
    });
    /*****************************************************************************/
    var georgiaPos = new google.maps.LatLng(41.97582726102573, 43.48388671875);
    var georgia = new google.maps.Marker({
        position: georgiaPos,
        icon: 'catalog/view/javascript/gmap/Flags/g/Georgia.png'
    });
    georgia.setMap(map);
    google.maps.event.addListener(georgia, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=80";
    });
    /*****************************************************************************/
    var armeniaPos = new google.maps.LatLng(40.27952566881291, 44.659423828125);
    var armenia = new google.maps.Marker({
        position: armeniaPos,
        icon: 'catalog/view/javascript/gmap/Flags/a/Armenia.png'
    });
    armenia.setMap(map);
    google.maps.event.addListener(armenia, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=11";
    });
    /*****************************************************************************/
    var azerbaijanPos = new google.maps.LatLng(40.10328591293442, 47.57080078125);
    var azerbaijan = new google.maps.Marker({
        position: azerbaijanPos,
        icon: 'catalog/view/javascript/gmap/Flags/a/Azerbaijan.png'
    });
    azerbaijan.setMap(map);
    google.maps.event.addListener(azerbaijan, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=15";
    });
    /*****************************************************************************/
    var kazakhstanPos = new google.maps.LatLng(47.84265762816535, 67.060546875);
    var kazakhstan = new google.maps.Marker({
        position: kazakhstanPos,
        icon: 'catalog/view/javascript/gmap/Flags/k/Kazakhstan.png'
    });
    kazakhstan.setMap(map);
    google.maps.event.addListener(kazakhstan, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=109";
    });
    /*****************************************************************************/
    var uzbekistanPos = new google.maps.LatLng(40.91351257612757, 63.6328125);
    var uzbekistan = new google.maps.Marker({
        position: uzbekistanPos,
        icon: 'catalog/view/javascript/gmap/Flags/u/Uzbekistan.png'
    });
    uzbekistan.setMap(map);
    google.maps.event.addListener(uzbekistan, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=226";
    });
    /*****************************************************************************/
    var turkmenistanPos = new google.maps.LatLng(38.65119833229951, 58.7548828125);
    var turkmenistan = new google.maps.Marker({
        position: turkmenistanPos,
        icon: 'catalog/view/javascript/gmap/Flags/t/Turkmenistan.png'
    });
    turkmenistan.setMap(map);
    google.maps.event.addListener(turkmenistan, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=216";
    });
    /*****************************************************************************/
   /* var iranPos = new google.maps.LatLng(38.65119833229951, 58.7548828125);
    var iran = new google.maps.Marker({
        position: iranPos,
        icon: 'catalog/view/javascript/gmap/Flags/i/Iran.png'
    });
    iran.setMap(map);
    google.maps.event.addListener(iran, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=101";
    });*/
    /*****************************************************************************/
    var iraqPos = new google.maps.LatLng(33.100745405144245, 43.505859375);
    var iraq = new google.maps.Marker({
        position: iraqPos,
        icon: 'catalog/view/javascript/gmap/Flags/i/Iraq.png'
    });
    iraq.setMap(map);
    google.maps.event.addListener(iraq, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=102";
    });
    /*****************************************************************************/
    var syriaPos = new google.maps.LatLng(34.89494244739732, 38.529052734375);
    var syria = new google.maps.Marker({
        position: syriaPos,
        icon: 'catalog/view/javascript/gmap/Flags/s/Syria.png'
    });
    syria.setMap(map);
    google.maps.event.addListener(syria, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=205";
    });
    /*****************************************************************************/
  /*  var lebanonPos = new google.maps.LatLng(34.89494244739732, 38.529052734375);
    var lebanon = new google.maps.Marker({
        position: lebanonPos,
        icon: 'catalog/view/javascript/gmap/Flags/l/Lebanon.png'
    });
    lebanon.setMap(map);
    google.maps.event.addListener(lebanon, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=118";
    });*/
    /*****************************************************************************/
    var israelPos = new google.maps.LatLng(31.75619625757132, 34.95849609375);
    var israel = new google.maps.Marker({
        position: israelPos,
        icon: 'catalog/view/javascript/gmap/Flags/i/Israel.png'
    });
    israel.setMap(map);
    google.maps.event.addListener(israel, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=104";
    });
    /*****************************************************************************/
    var jordanPos = new google.maps.LatLng(31.09998179374943, 36.58447265625);
    var jordan = new google.maps.Marker({
        position: jordanPos,
        icon: 'catalog/view/javascript/gmap/Flags/j/Jordan.png'
    });
    jordan.setMap(map);
    google.maps.event.addListener(jordan, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=108";
    });
    /*****************************************************************************/
    var kyrgyzstanPos = new google.maps.LatLng(41.178653972331695, 74.6630859375);
    var kyrgyzstan = new google.maps.Marker({
        position: kyrgyzstanPos,
        icon: 'catalog/view/javascript/gmap/Flags/k/Kyrgyzstan.png'
    });
    kyrgyzstan.setMap(map);
    google.maps.event.addListener(kyrgyzstan, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=115";
    });
    /*****************************************************************************/
    var tajikistanPos = new google.maps.LatLng(38.788345355085625, 71.103515625);
    var tajikistan = new google.maps.Marker({
        position: tajikistanPos,
        icon: 'catalog/view/javascript/gmap/Flags/t/Tajikistan.png'
    });
    tajikistan.setMap(map);
    google.maps.event.addListener(tajikistan, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=207";
    });
    /*****************************************************************************/
    var afghanistanPos = new google.maps.LatLng(33.94335994657882, 66.11572265625);
    var afghanistan = new google.maps.Marker({
        position: afghanistanPos,
        icon: 'catalog/view/javascript/gmap/Flags/a/Afghanistan.png'
    });
    afghanistan.setMap(map);
    google.maps.event.addListener(afghanistan, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=1";
    });
    /*****************************************************************************/
    var pakistanPos = new google.maps.LatLng(29.36302703778376, 69.3017578125);
    var pakistan = new google.maps.Marker({
        position: pakistanPos,
        icon: 'catalog/view/javascript/gmap/Flags/p/Pakistan.png'
    });
    pakistan.setMap(map);
    google.maps.event.addListener(pakistan, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=162";
    });
    /*****************************************************************************/
    var indiaPos = new google.maps.LatLng(22.573438264572406, 79.6728515625);
    var india = new google.maps.Marker({
        position: indiaPos,
        icon: 'catalog/view/javascript/gmap/Flags/i/India.png'
    });
    india.setMap(map);
    google.maps.event.addListener(india, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=99";
    });
    /*****************************************************************************/
    var egyptPos = new google.maps.LatLng(26.254009699865733, 29.64111328125);
    var egypt = new google.maps.Marker({
        position: egyptPos,
        icon: 'catalog/view/javascript/gmap/Flags/e/Egypt.png'
    });
    egypt.setMap(map);
    google.maps.event.addListener(egypt, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=63";
    });
    /*****************************************************************************/
    var libyaPos = new google.maps.LatLng(26.735799020431674, 17.55615234375);
    var libya = new google.maps.Marker({
        position: libyaPos,
        icon: 'catalog/view/javascript/gmap/Flags/l/Libya.png'
    });
    libya.setMap(map);
    google.maps.event.addListener(libya, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=121";
    });
    /*****************************************************************************/
    var algeriaPos = new google.maps.LatLng(27.9361805667694, 2.52685546875);
    var algeria = new google.maps.Marker({
        position: algeriaPos,
        icon: 'catalog/view/javascript/gmap/Flags/a/Algeria.png'
    });
    algeria.setMap(map);
    google.maps.event.addListener(algeria, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=3";
    });
    /*****************************************************************************/
    var tunisiaPos = new google.maps.LatLng(33.8521697014074, 9.525146484375);
    var tunisia = new google.maps.Marker({
        position: tunisiaPos,
        icon: 'catalog/view/javascript/gmap/Flags/t/Tunisia.png'
    });
    tunisia.setMap(map);
    google.maps.event.addListener(tunisia, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=214";
    });
    /*****************************************************************************/
    var moroccoPos = new google.maps.LatLng(31.653381399664, -6.240234375);
    var morocco = new google.maps.Marker({
        position: moroccoPos,
        icon: 'catalog/view/javascript/gmap/Flags/m/Morocco.png'
    });
    morocco.setMap(map);
    google.maps.event.addListener(morocco, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=144";
    });
    /*****************************************************************************/
    var chinaPos = new google.maps.LatLng(35.721988,100.986328);
    var china = new google.maps.Marker({
        position: chinaPos,
        icon: 'catalog/view/javascript/gmap/Flags/c/China.png'
    });
    china.setMap(map);
    google.maps.event.addListener(china, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=44";
    });
    /*****************************************************************************/
    var mongoliaPos = new google.maps.LatLng(46.88507,103.205566);
    var mongolia = new google.maps.Marker({
        position: mongoliaPos,
        icon: 'catalog/view/javascript/gmap/Flags/m/Mongolia.png'
    });
    mongolia.setMap(map);
    google.maps.event.addListener(mongolia, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=142";
    });
    /*****************************************************************************/
    var iranPos = new google.maps.LatLng(32.094791,54.382324);
    var iran = new google.maps.Marker({
        position: iranPos,
        icon: 'catalog/view/javascript/gmap/Flags/i/Iran.png'
    });
    iran.setMap(map);
    google.maps.event.addListener(iran, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=101";
    });
    /*****************************************************************************/
    var saudi_ArabiaPos = new google.maps.LatLng(23.355495,45.32959);
    var saudi_Arabia = new google.maps.Marker({
        position: saudi_ArabiaPos,
        icon: 'catalog/view/javascript/gmap/Flags/s/Saudi_Arabia.png'
    });
    saudi_Arabia.setMap(map);
    google.maps.event.addListener(saudi_Arabia, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=184";
    });
    /*****************************************************************************/
    var united_arab_emiratesPos = new google.maps.LatLng(23.500089,54.30542);
    var united_arab_emirates = new google.maps.Marker({
        position: united_arab_emiratesPos,
        icon: 'catalog/view/javascript/gmap/Flags/u/United_Arab_Emirates.png'
    });
    united_arab_emirates.setMap(map);
    google.maps.event.addListener(united_arab_emirates, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=221";
    });
    /*****************************************************************************/
    var cyprusPos = new google.maps.LatLng(35.037446,33.250122);
    var cyprus = new google.maps.Marker({
        position: cyprusPos,
        icon: 'catalog/view/javascript/gmap/Flags/c/Cyprus.png'
    });
    cyprus.setMap(map);
    google.maps.event.addListener(cyprus, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=55";
    });
    /*****************************************************************************/
    var lebanonPos = new google.maps.LatLng(33.988136,35.884094);
    var lebanon = new google.maps.Marker({
        position: lebanonPos,
        icon: 'catalog/view/javascript/gmap/Flags/l/Lebanon.png'
    });
    lebanon.setMap(map);
    google.maps.event.addListener(lebanon, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=118";
    });
    /*****************************************************************************/
    var usaPos = new google.maps.LatLng(39.560177,-102.612305);
    var usa = new google.maps.Marker({
        position: usaPos,
        icon: 'catalog/view/javascript/gmap/Flags/u/Usa.png'
    });
    usa.setMap(map);
    google.maps.event.addListener(usa, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=223";
    });
    /*****************************************************************************/
    var canadaPos = new google.maps.LatLng(58.889039,-107.138672);
    var canada = new google.maps.Marker({
        position: canadaPos,
        icon: 'catalog/view/javascript/gmap/Flags/c/Canada.png'
    });
    canada.setMap(map);
    google.maps.event.addListener(canada, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=38";
    });
    /*****************************************************************************/
    var argentinaPos = new google.maps.LatLng(-36.197742,-64.248047);
    var argentina = new google.maps.Marker({
        position: argentinaPos,
        icon: 'catalog/view/javascript/gmap/Flags/a/Argentina.png'
    });
    argentina.setMap(map);
    google.maps.event.addListener(argentina, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=10";
    });
    /*****************************************************************************/
    var southAfricaPos = new google.maps.LatLng(-29.923399,24.016113);
    var southAfrica = new google.maps.Marker({
        position: southAfricaPos,
        icon: 'catalog/view/javascript/gmap/Flags/s/SouthAfrica.png'
    });
    southAfrica.setMap(map);
    google.maps.event.addListener(southAfrica, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=193";
    });
    /*****************************************************************************/
    var brazilPos = new google.maps.LatLng(-11.035560,-50.185547);
    var brazil = new google.maps.Marker({
        position: brazilPos,
        icon: 'catalog/view/javascript/gmap/Flags/b/Brazil.png'
    });
    brazil.setMap(map);
    google.maps.event.addListener(brazil, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=30";
    });
    /*****************************************************************************/
    var mexicoPos = new google.maps.LatLng(23.436159,-102.458496);
    var mexico = new google.maps.Marker({
        position: mexicoPos,
        icon: 'catalog/view/javascript/gmap/Flags/m/Mexico.png'
    });
    mexico.setMap(map);
    google.maps.event.addListener(mexico, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=138";
    });
    /*****************************************************************************/
    var sudanPos = new google.maps.LatLng(16.207422,30.607910);
    var sudan = new google.maps.Marker({
        position: sudanPos,
        icon: 'catalog/view/javascript/gmap/Flags/s/Sudan.png'
    });
    sudan.setMap(map);
    google.maps.event.addListener(sudan, 'click', function () {
        window.location.href = "?route=customer/customer&country_id=119";
    });
    /*****************************************************************************/  
    
    
    
    
}

google.maps.event.addDomListener(window, 'load', initialize);
