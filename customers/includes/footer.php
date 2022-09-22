</main>
</div>
</div>
<footer>
<p>&copy2022 - immoplus - NAN PROJECT - bfabien99</p>
</footer>
</body>
</html>
<script>
    //MenuToggle
    let toggle = document.querySelector('.toggle');
    let navigation = document.querySelector('.navigation');

    toggle.onclick = function() {
        navigation.classList.toggle('active');
    }

    // add hovered class on selected list item
    let properties = document.querySelectorAll('.property');
    properties.forEach((item)=>{
        item.addEventListener('mouseover',function(){
            this.classList.toggle('active')
        })
        item.addEventListener('mouseout',function(){
            this.classList.toggle('active')
        })
    })

    //see password on double click
    var pass = document.querySelector('#password');
    if(pass != null){
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
    console.log(logout);
    $('#logout').on('click',function(){
        $.ajax({
                url: "/immoplus/customers/_logout.php",
                method: "POST",
                data: {
                    input: true,
                },
                success: function(data) {
                    if (data) {
                        window.location.href = '/immoplus/customers'
                    }

                }
            })
    })
</script>