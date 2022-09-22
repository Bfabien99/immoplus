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
</script>