  window.addEventListener("load", function(){
    cart.load();
    cart.list();
  });

  var cart = {
    data: {},
    products: [],
    items:function(){
      var count = 0;
      cart.products.forEach(p => {
        count += parseInt(p.quantidade);
      });
      return count;
    },
    load:function () {
      cart.products = localStorage.getItem("products");
      if(cart.products == null) { cart.products = []; }
      else {cart.products = JSON.parse(cart.products); }
    },
    save:function(){
      localStorage.setItem("products", JSON.stringify(cart.products));
    },
    add:function(e, form){
      e.preventDefault();
      var product = formToJSON(form.elements);
      var fromCart = cart.find(product.id);
      if(!fromCart){ // No products yet
        cart.products.push(product);
      } else {
        fromCart['quantidade']++;
      }
      cart.save();
      console.log(`Add item `)
      console.log(JSON.stringify(cart.products));
    },
    find:function(item){
      return cart.products.find(i => {
        return i.id === item;
      });
    },
    remove:function(item){
      var idx = cart.products.indexOf(item);
      cart.products.splice(idx, 1);
    },
    list:function(){
      cart.load();
      var cartList = document.getElementById("cart-list"),
      checkoutForm = document.getElementById('checkout-form'),
      tableRow = null, inputQty = null;
      cartList.innerHTML = "";

      if(cart.products.length === 0){
        tableRow = document.createElement("tr");
        tableRow.innerHTML = "Cart is empty";
        cartList.appendChild(tableRow);
      }
      else {
        var total = 0, subtotal = 0, counter = 1;
        cart.products.forEach(product => {
          tableRow = document.createElement("tr");

          var order = document.createElement("th");
          order.innerHTML = counter++;
          tableRow.appendChild(order);

          var idd = document.createElement("td");
          idd.innerHTML = product["id"];
          tableRow.appendChild(idd)

          var name = document.createElement("td");
          name.innerHTML = product['nome'];
          tableRow.appendChild(name);

          var price = document.createElement("td");
          price.innerHTML = product['preco_promocao'];
          tableRow.appendChild(price);

          var qty = document.createElement("td");

          var inputQty = document.createElement("input");

          inputQty.type = "number";
          inputQty.name = "pedido[item][][quantidade]";
          inputQty.value = product['quantidade'];
          inputQty.dataset.id = product['id'];
          inputQty.addEventListener("change", cart.change);
          qty.appendChild(inputQty);
          tableRow.appendChild(qty);

          prodInput = document.createElement("input");
          prodInput.type = "hidden";
          prodInput.name = "pedido[id][][quantidade]";
          prodInput.value = product["id"];
          tableRow.appendChild(prodInput);

          // subtotal
          subtotal = product['quantidade'] * product['preco_promocao'];
          total += subtotal;
          cartList.appendChild(tableRow);
        });

        inputQty = document.createElement("div");
        inputQty.innerHTML = this.items();
        cartList.appendChild(inputQty);

        // Empty buttons
        tableRow = document.createElement("input");
        tableRow.type = "button";
        tableRow.value = "Empty";
        tableRow.addEventListener("click", cart.reset);
        tableRow.classList.add("c-empty");
        cartList.appendChild(tableRow);

        tableRow = document.createElement("input");
        tableRow.type = "button";
        tableRow.value = `Checkout - R$ ${total}`;
        tableRow.addEventListener("click", cart.checkout);
        tableRow.classList.add("c-checkout");
        cartList.appendChild(tableRow);
      }
    },
    change:function(){
      var product = cart.find(this.dataset.id);
      if(this.value == 0){
        cart.remove(product);
      }
      else{
        product['quantidade'] = this.value;
      }
      cart.save();
      cart.list();
    },
    reset:function(){
      if(confirm("Empty Cart?")){
        cart.products = [];
        cart.save();
        cart.list();
      }
    },
    checkout:function(){
      var pedido = {};
      var endereco = document.getElementById('novo-endereco');
      var telefone = document.getElementById('novo-telefone');
      pedido.itens = cart.products;
      pedido.endereco = formToJSON(endereco);
      pedido.telefone = formToJSON(telefone);
      cart.request(
          'http://localhost:8000/checkout',
          'post',
          function(){console.log("Requisição pronta!")},
          pedido,
          function () {console.log('Aguardando resposta')});
      },
    request:function(action, method, doneCallback, data, waitCallback = console.log, fallback = console.log){
      let request = new XMLHttpRequest();
      let token = document.getElementsByName('_token')[0].value;

      request.onreadystatechange = function () {
        if (request.readyState === request.DONE) {
          if (request.status === 200 || request.status === 201)
            doneCallback(request.responseURL, request.responseText);
          else fallback(data, request.responseText);
        } else {
          waitCallback(request.responseURL, request.responseText);
        }
      }
      request.open(method, action, true);
      request.setRequestHeader('X-CSRF-TOKEN', token);
      request.setRequestHeader('Content-type', 'application/json');
      request.send(JSON.stringify(data));
    }
  };

const formToJSON = elements => {
  return [].reduce.call(elements, (data, element) => {
    //TODO: Recursão para não haver limite de profundidade
    if (isTextField(element) || isChecked(element)) {
      let keys = element.name.split(".");
      if (keys.length === 1) {
        data[keys[0]] = element.value;
      } else if (keys.length === 2) {
        data[keys[0]] = data[keys[0]] || {};
        data[keys[0]][keys[1]] = element.value;
      } else {
        data[keys[0]] = data[keys[0]] || {};
        data[keys[0]][keys[1]] = data[keys[0]][keys[1]] || {};
        data[keys[0]][keys[1]][keys[2]] = element.value;
      }
    }

    return data;
  }, {});
};

const isFormField = element => {
  return !!element && element.name && ['TEXTAREA', 'INPUT'].includes(element.nodeName);
};

/**
 * Verifica se o elemento é checkable, e se está marcado
 * @param {HTMLElement} element
 */
const isChecked = element => {
  return (isCheckableField() || element.checked);
};
/**
 * Verifica se é um elemento checável (duh), seja checkbox ou radiobutton
 * @param element
 * @returns {boolean}
 */
const isCheckableField = element => {
  return !!element && ['checkbox', 'radio'].includes(element.type);
}

/**
 * Verifica se o elemento de texto está vazio
 * @param element
 * @returns {boolean}
 */
const isEmptyValue = element => {
  if (element.inputmask) {
    return !element.inputmask.isComplete();
  } else {
    return element.value === "";
  }
}

const isOptional = element => {
  return Array.from(element.classList).includes('ea-optional-field');
}

const isTextField = element => {
  return ['text', 'hidden'].includes(element.type) || element.nodeName === 'TEXTAREA';
}
