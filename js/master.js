function toggleHamburger(obj) {
    
    var ham_links = document.getElementById('ham-links');

    var current_hamburger_classes = obj.classList;

    var current_hamburger_classes_array = Array.from(current_hamburger_classes);

    if(current_hamburger_classes_array.includes("active")){

        obj.classList.remove('active');

        ham_links.classList.replace('display_ham_links','ham-links');
        
    } else {
        
        obj.classList.add('active');

        ham_links.classList.replace('ham-links','display_ham_links');

    }

}