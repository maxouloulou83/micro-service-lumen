//app.js
const express = require('express');
const bodyParser = require('body-parser');
const mongoose = require('mongoose');

// init app
const app = express();

// connect MongoDB with mongoose
let dev_db_url = 'mongodb://localhost:27017';
let mongoDB = process.env.MONGODB_URI||dev_db_url ;
mongoose.connect(mongoDB) ;
mongoose.Promise = global.Promise;
let db = mongoose.connection;
db.on('error ', console.error.bind(console , 'Connexion error on MongoDB : '));

// Utilisation de body parser
app.use (bodyParser.json ());
app.use (bodyParser.urlencoded ({ extended : false }));

let port = 5555;

app.listen(
    port, () => {
        console.log (' Server running on : ' + port );
    }
);