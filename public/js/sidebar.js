document.addEventListener('DOMContentLoaded', () => {

    const sidebar = document.getElementById('smenu')

    sidebar.addEventListener('click', () => {
        document.getElementById('sidebar').style.transform = "translateX(330px)"
    })

    sidebar.addEventListener('mouseleave', () => {
        document.getElementById('sidebar').style.transform = "translateX(-330px)"
    })

})