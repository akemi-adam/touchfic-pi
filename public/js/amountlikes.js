const likesDisplay = document.getElementById('likes')

function incrementDisplay() {
    const likes = likesDisplay.innerHTML.replace(/[^\d,]/g, '')
    const enjoyButton = document.getElementById('enjoy')
    console.log(`${likes} + 1 = ${parseInt(likes) + 1}`);
    likesDisplay.innerHTML = 'Curtidas: ' + (parseInt(likes) + 1);
}

function decrementDisplay() {
    const likes = likesDisplay.innerHTML.replace(/[^\d,]/g, '')
    const unlikeButton = document.getElementById('unlike')
    console.log(`${likes} - 1 = ${parseInt(likes) - 1}`);
    likesDisplay.innerHTML = 'Curtidas: ' + (parseInt(likes) - 1);
}