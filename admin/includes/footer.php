</main>
<div class="footer">
    <p>&copy2022 - immoplus - NAN PROJECT - bfabien99</p>
</div>
</div>

</div>

</body>
<script>
    //MenuToggle
    let toggle = document.querySelector('.toggle');
    let navigation = document.querySelector('.navigation');
    let main = document.querySelector('.main');

    toggle.onclick = function() {
        navigation.classList.toggle('active');
        main.classList.toggle('active');
    }

    // add hovered class on selected list item
    let list = document.querySelectorAll('.navigation li');

    function activeLink() {
        list.forEach((item) =>
            item.classList.remove('hovered'));
        this.classList.add('hovered');
    }
    list.forEach((item) =>
        item.addEventListener('mouseover', activeLink))

    // add hovered class on selected list item
    let properties = document.querySelectorAll('.property');
    properties.forEach((item) => {
        item.addEventListener('mouseover', function() {
            this.classList.toggle('active')
        })
        item.addEventListener('mouseout', function() {
            this.classList.toggle('active')
        })
    })

    //see password on double click
    var pass = document.querySelector('#password');
    if (pass != null) {
        pass.addEventListener('dblclick', function() {
            if (pass.getAttribute('type') == 'password') {
                pass.setAttribute('type', 'text')
            } else {
                pass.setAttribute('type', 'password')
            }
        })
    }


    //logout
    var logout = document.querySelector('#logout');
    $('#logout').on('click', function(e) {

        e.preventDefault();
        Swal.fire({
            title: 'Voulez-vous vous deconnecter?',
            showDenyButton: true,
            confirmButtonText: 'Deconnecter',
            denyButtonText: `Annuler`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: "/immoplus/admin/_logout.php",
                    method: "POST",
                    data: {
                        input: true,
                    },
                    success: function(data) {
                        if (data) {
                            window.location.href = '/immoplus/login'
                        }
                    }
                })
                window.location.href = '/immoplus/login'
            }
        })




    })
</script>

</html>