let app = require('express');
const DiscussionController = require("../Controllers/DiscussionController");

let Route = app.Router();

Route.get('/', function (req, res) {
    DiscussionController.index(req, res)
})

Route.post('/', function (req, res) {
    DiscussionController.store(req, res);
})

Route.get('/:id', function (req, res) {
    DiscussionController.show(req, res);
})

Route.put('/:id', function (req, res) {
    DiscussionController.update(req, res);
})

Route.delete('/:id', function (req, res) {
    DiscussionController.destroy(req, res);
})

module.exports = Route;
