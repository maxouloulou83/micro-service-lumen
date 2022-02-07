const Mongoose = require("mongoose")


const DiscussionSchema = new Mongoose.Schema({
    title: {
        type: String,
        minlength: 5,
        maxlength: 20,
        required: true,
    },
    author: String,
    body: String,
    date: { type: Date, default: Date.now },
    hidden: Boolean,
});


const Discussion = Mongoose.model('discussions', DiscussionSchema);

module.exports = Discussion;