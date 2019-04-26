// Condition of type switcher position
$("#switcher").change(function() {
  var id = $(this)
    .children(":selected")
    .prop("id");

  if (id === "book_option") {
    // Clear child elements added before
    $("#SwitcherBoxes").empty();

    //Create a div
    var div = $("<div>Weight:<br></div>");

    //Append the div into "SwitcherBoxes" div
    $("#SwitcherBoxes").append(div);

    //Insert textbox and into the div recently created
    $("<input />", {
      type: "text",
      id: "weightInput",
      value: "",
      name: "weight"
    }).appendTo(div);
    $("<br><text>Please provide the weight attribute in Kg</text>").appendTo(
      div
    );
  } else if (id === "furniture_option") {
    // Clear child elements added before
    $("#SwitcherBoxes").empty();

    //Create a div
    var div = $("<div></div>");

    //Append the div into "SwitcherBoxes" div
    $("#SwitcherBoxes").append(div);

    //Insert textbox and into the div recently created
    $("<br><text>Height:</text>").appendTo(div);
    $("<input />", {
      type: "text",
      id: "heightInputbox",
      value: "",
      name: "height"
    }).appendTo(div);

    $("<br><text>Width:</text>").appendTo(div);
    $("<input />", {
      type: "text",
      id: "widthInputbox",
      value: "",
      name: "width"
    }).appendTo(div);

    $("<br><text>Length:</text>").appendTo(div);
    $("<input />", {
      type: "text",
      id: "lengthInputbox",
      value: "",
      name: "length"
    }).appendTo(div);

    $(
      "<br><text>Please provide the dimensions in HxWxL format</text>"
    ).appendTo(div);
  } else if (id === "dvd_option") {
    // Clear child elements added before
    $("#SwitcherBoxes").empty();

    //Create a div
    var div = $("<div>Size:<br></div>");

    //Append the div into "SwitcherBoxes" div
    $("#SwitcherBoxes").append(div);

    //Insert textbox and into the div recently created
    $("<input />", {
      type: "text",
      id: "SizeInputbox",
      value: "",
      name: "size"
    }).appendTo(div);
    $("<br><text>Please provide the size attribute in MB</text>").appendTo(div);
  }
});

function PostRequest() {
  //Get data from the all inputboxes
  var sku = $("#newProductDiv")
    .find('input[name="sku"]')
    .val();

  var name = $("#newProductDiv")
    .find('input[name="name"]')
    .val();

  var price = $("#newProductDiv")
    .find('input[name="price"]')
    .val();

  var weight = $("#SwitcherBoxes")
    .find('input[name="weight"]')
    .val();

  var size = $("#SwitcherBoxes")
    .find('input[name="size"]')
    .val();

  var height = $("#SwitcherBoxes")
    .find('input[name="height"]')
    .val();

  var width = $("#SwitcherBoxes")
    .find('input[name="width"]')
    .val();

  var length = $("#SwitcherBoxes")
    .find('input[name = "length"]')
    .val();

  // To use dimensions in HxWxL format
  var dimensions = height + "x" + width + "x" + length;

  // Use given data post to the server
  // If switcher is (Book) then (size) and (dimensions) will be undefined to post correctly
  var obj = {
    sku: sku,
    name: name,
    price: price,
    weight: weight,
    size: size,
    dimensions: dimensions
  };

  // Make request for save the data
  axios
    .post("http://localhost:8000", obj)
    .then(function(response) {
      console.log(response);
    })
    .catch(function(error) {
      console.log(error);
    });
}
