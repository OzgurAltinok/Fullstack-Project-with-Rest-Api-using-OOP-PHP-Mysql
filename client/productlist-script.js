// Create axios get request
axios
  .get("http://localhost:8000")
  .then(function(response) {
    // Iterating over entries in data
    response.data.forEach((value, i) => {
      //This is for seperating different types of data
      var uniqueIdentifier;
      if (Object.keys(value)[3] == "weight") {
        uniqueIdentifier = Object.values(value)[3] + "KG";
      } else if (Object.keys(value)[3] == "size") {
        uniqueIdentifier = "Size:" + Object.values(value)[3] + "MB";
      } else uniqueIdentifier = "Dimensions:" + Object.values(value)[3];

      //Use p tag for storing elements
      var myP = $(
        "<p>" +
          Object.values(value)[0] +
          " " +
          Object.values(value)[1] +
          " " +
          Object.values(value)[2] +
          "$ " +
          uniqueIdentifier +
          "</p>"
      );

      $("<input />", {
        type: "checkbox",
        id: "isSelected" + i,
        name: "productCheck"
      }).appendTo(myP);

      $("#productListDiv").append(myP);
    });

    $("#isSelected2").click(function() {
      var $div = $(this);
      console.log($div.parent().text());
    });
  })
  .catch(function(error) {
    console.log(error);
  });
