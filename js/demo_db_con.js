var mysql = require('mysql');

var con = mysql.createConnection({
  host: "localhost",
  user: "pattana",
  password: "1234qwer"
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
});
