

const imageUpload = document.getElementById('imageUpload')
console.log(imageUpload)
Promise.all([
  faceapi.nets.faceRecognitionNet.loadFromUri('js/models2'),
  faceapi.nets.faceLandmark68Net.loadFromUri('js/models2'),
  faceapi.nets.ssdMobilenetv1.loadFromUri('js/models2')
  ]).then(start)

  async function start() {
	 
  const container = document.createElement('div')
  container.style.position = 'relative'
  document.body.append(container)
  const labeledFaceDescriptors = await loadLabeledImages()
  const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6)
  let image
  let canvas
  document.body.append('ready')
  alert('ready')
  imageUpload.addEventListener('change', async () => {
    alert(image)
    if (image) image.remove()
      if (canvas) canvas.remove()
        image = await faceapi.bufferToImage(imageUpload.files[0])
    container.append(image)
      canvas = faceapi.createCanvasFromMedia(image)
     container.append(canvas)
      //console.log(canvas)
      const displaySize = { width: image.width, height: image.height }
      faceapi.matchDimensions(canvas, displaySize)
      const detections = await faceapi.detectAllFaces(image).withFaceLandmarks().withFaceDescriptors()
     // console.log(detections)
      const resizedDetections = faceapi.resizeResults(detections, displaySize)
	  faceapi.draw.drawFaceLandmarks(canvas, resizedDetections)
      const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
     // console.log(results[0]._label+'kkkk')
      results.forEach((result, i) => {
        const box = resizedDetections[i].detection.box
        const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
        drawBox.draw(canvas)
      })
        alert(results[0].distance)
       var daa = localStorage.getItem('data');

       if (results[0].label == daa) {
        alert('ada');
      }else if(results[0].label == 'unknown' || results[0].label == 'undefined'){
      alert('tidak ada');

      }else{
         alert(results);
      }
    })
	}




function loadLabeledImages() {
   $.ajax({
   type: "GET",
   url: 'http://localhost/kp/public/api/getlabel/20001',
   data: '',
   crossDomain: true,
   cache: false,
   
   success: function(output){
  console.log(output[0]['name'])
//tmp[0] = output[0]['name'];
 
  var has = output[0]['name'];
   localStorage.setItem('data',has);
   }
   ,error:function(){

   }
 })


  var daa = localStorage.getItem('data');

 console.log(daa)
  var aa =  ['data']
aa[0] = daa;



const label = ['rosida'/*, 'Captain America', 'Captain Marvel', 'Hawkeye', 'Jim Rhodes', 'Thor', 'Tony Stark','nunik'*/]


  // var x = labels.toString();
   //la.push(x);
  

   // var m = [];
   // for(var i = 0;i<2; i++){
   //   m.push(label[i]);
   // }
   // console.log(l)


   return Promise.all(
     label.map(async label => {

       const descriptions = []
       for (let i = 1; i <= 2; i++) {
         const img = await faceapi.fetchImage(`labeled_images/${label}/${i}.jpg`)
         const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
         descriptions.push(detections.descriptor)
}

return new faceapi.LabeledFaceDescriptors(label, descriptions)
})
     )
 }
