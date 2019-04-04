function getData(url=``,data={}){
    return fetch(url, {
            method: "POST",
            credentials: "same-origin",
            headers: {
             "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        })
        .then(res => res.text())
        .catch(err => console.log(err));
};
window.onload = () => {
    const searchInput = document.querySelector("#search-input");
    const searchHintsOutput = document.querySelector(".search-hints");
    searchInput.addEventListener("input", function(){
      let inputVal = this.value;
      (async () => {
          let data = await getData(`include/searchHandle.php`, {searchInput:inputVal});
          searchHintsOutput.innerHTML = data;     
      })();
  }); 
};