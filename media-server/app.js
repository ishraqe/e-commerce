var express = require('express'),
cors = require('cors'),
fs = require('fs'),
path = require('path'),
formidable = require('formidable'),
app = express(),
server = require('http').createServer(app),
port = 3500,
ipAddress = '0.0.0.0',
uploadDir = '/home/ish/Desktop/artisan/e-commerce/public/products_images',
filename = '';


app.use(cors());
app.options('*', cors());

server.listen(port, ipAddress, 
	function () {  
	  console.log('Media server started in ' + ipAddress + ' on port ' + port + '!');
	}
);

app.get('/', function (req, res) { 
   res.sendfile(__dirname + '/package.json');
});
app.post('/uploadImageFile', function (req, res) {

		var form = new formidable.IncomingForm();   
		form.multiples = true;   

		form.uploadDir = path.join(uploadDir);

		form.on('file', function (field, file) {     
		var info = file.name;     
		var ext = info.split('.').pop();     
		filename = Date.now() + '.' + ext;       
		fs.rename(file.path, path.join(form.uploadDir, filename));    
		});

		form.on('error', function (err) {   
		  console.log('An error has occured: \n' + err); 

		}); 

		form.on('end', function () {    
		res.end(filename);    
		filename = '';   
		});  

		form.parse(req);

});