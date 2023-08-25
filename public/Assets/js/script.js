window.onload = () => {

    const tabs = document.querySelectorAll(".tab");
    const contents = document.querySelectorAll(".content");
    let active = document.querySelector(".active");
    let target = active.dataset.target;

    affiche();

    // On affiche le contenu de l'onglet actif
    document.querySelector(target).classList.add("show");

    

    /**
     * Cette fonction gère le changement d'affichage
     */
    function affiche(){
        // On boucle sur tous les onglets
        for(let tab of tabs){
            // On retire les écouteurs d'évènements
            tab.removeEventListener("click", tabClick);

            // On vérifie si l'onglet est actif
            if(tab !== active){
                tab.addEventListener("click", tabClick);
                tab.classList.remove("active");
            }
        }
        
        // On boucle sur les contenus
        for(let content of contents){
            content.classList.remove("show");
        }
    }

    function tabClick(){
        target = this.dataset.target;
        active = this;
        this.classList.add("active");
        
        // On active le bon onglet et on "efface" les contenus
        affiche();

        // On affiche le contenu correspondant à l'onglet cliqué
        document.querySelector(target).classList.add("show");
    }
    
}