// Create an array to store data
const arr = [];

// Create axios get request
axios
  .get("http://localhost:8000")
  .then(function(response) {
    // Add the data to array
    arr.push(response.data);

    // Create box for all entries
    arr[0].forEach((value, i) => {
      // DOM things to create boxes for each array element
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

      document.getElementById("productListDiv").appendChild(box);
    });
  })
  .catch(function(error) {
    console.log(error);
  });
