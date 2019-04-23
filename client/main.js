const arr = [];

axios
  .get("http://localhost:8000")
  .then(function(response) {
    arr.push(response.data);

    arr[0].forEach((value, i) => {
      var box = document.createElement("p");
      var text = document.createTextNode(
        value.sku + "\n" + value.name + "\n" + value.price
      );
      var checkBox = document.createElement("input");

      checkBox.type = "checkbox";
      checkBox.name = "productCheck";
      checkBox.id = "isSelected" + i;
      checkBox.className = "CheckClass";
      //   checkBox.checked = "checked";

      box.appendChild(text);
      box.appendChild(checkBox);

      document.getElementById("one").appendChild(box);
    });
  })
  .catch(function(error) {
    console.log(error);
  });
