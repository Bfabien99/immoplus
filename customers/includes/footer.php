</main>
</div>
</div>
<footer>
<p>&copy2022 - immoplus - NAN PROJECT - bfabien99</p>
</footer>
</body>
</html>
<script>
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