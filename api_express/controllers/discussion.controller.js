const Discussion = require('../Models/Discussion')

async function index(req, res) {
    const discussions = await Discussion.find();
    res.json(discussions);
}

async function store(req, res) {
    const discussion = new Discussion({
        title: req.query.title
    })

    await discussion.save()
        .then(() => res.status(201).json(discussion))
        .catch(err => res.status(400).json('Something went wrong: ' + err))
}

async function show(req, res) {
    await Discussion.findById(req.params.id)
        .then(discussion => res.status(201).json(discussion))
        .catch(err => res.status(400).json('Something went wrong: ' + err))
}

async function update(req, res) {
    const discussion = await Discussion.findByIdAndUpdate(req.params.id)

    discussion.title = req.query.title

    await discussion.save()
        .then(() => res.status(201).json(discussion))
        .catch(err => res.status(400).json('Something went wrong: ' + err))
}

async function destroy(req, res) {
    await Discussion.findByIdAndDelete(req.params.id)
        .then(() => res.status(201).json({'message': 'Deleted'}))
        .catch(err => res.status(400).json('Something went wrong: ' + err))
}

module.exports = {
    index,
    store,
    show,
    update,
    destroy
}
