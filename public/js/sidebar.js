document.addEventListener('DOMContentLoaded', () => {

    const smenu = document.getElementById('smenu')

    smenu.addEventListener('click', () => {

        const sidebar = document.getElementById('sidebar')

        sidebar.style.transform = "translateX(330px)"

        sidebar.addEventListener('mouseleave', () => {
            sidebar.style.transform = "translateX(-330px)";
        })

        document.onkeydown = function(e) {
            if(e.key === 'Escape') {
                sidebar.style.transform = "translateX(-330px)";
            }
        }

    })

})