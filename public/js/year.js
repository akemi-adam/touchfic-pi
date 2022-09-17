function calcYear() {

    var date = new Date()
    var year = date.getFullYear()

    var y = document.getElementById('year')

    y.innerHTML = `${year}`
}