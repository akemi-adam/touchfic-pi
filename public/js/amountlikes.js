const likesDisplay = document.getElementById('likes')

function incrementDisplay() {
    const likes = likesDisplay.innerHTML.replace(/[^\d,]/g, '')
    console.log(`${likes} + 1 = ${parseInt(likes) + 1}`);
    likesDisplay.innerHTML = 'Curtidas: ' + (parseInt(likes) + 1);
}

function decrementDisplay() {
    const likes = likesDisplay.innerHTML.replace(/[^\d,]/g, '')
    console.log(`${likes} - 1 = ${parseInt(likes) - 1}`);
    likesDisplay.innerHTML = 'Curtidas: ' + (parseInt(likes) - 1);
}