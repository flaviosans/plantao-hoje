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
      if(cart.products == null) { cart.products = {}; }
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
      var container = document.getElementById("cart-list"),
        item = null, part = null;
      container.innerHTML = "";

      if(cart.products.length === 0){
        item = document.createElement("div");
        item.innerHTML = "Cart is empty";
        container.appendChild(item);
      }
      else {
        var total = 0; subtotal = 0;
        cart.products.forEach(product => {
          item = document.createElement("div");
          item.classList.add("c-item");

          part = document.createElement("input");
          part.type = "number";
          part.value = product['quantidade'];
          part.dataset.id = product['id'];
          part.classList.add("c-qty");
          part.addEventListener("change", cart.change);
          item.appendChild(part);

          part = document.createElement("span");
          part.innerHTML = product['nome'];
          part.classList.add("c-name");
          item.appendChild(part);

          // subtotal
          subtotal = product['quantidade'] * product['preco_promocao'];
          total += subtotal;
          container.appendChild(item);

        });

        part = document.createElement("div");
        part.innerHTML = this.items();
        container.appendChild(part);

        
        // Empty buttons
        item = document.createElement("input");
        item.type = "button";
        item.value = "Empty";
        item.addEventListener("click", cart.reset);
        item.classList.add("c-empty");
        container.appendChild(item);

        item = document.createElement("input");
        item.type = "button";
        item.value = `Checkout - R$${total}`;
        item.addEventListener("click", cart.checkout);
        item.classList.add("c-checkout");
        container.appendChild(item);
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
      var user = document.getElementById('customer-data');
      pedido.ofertas = cart.products;
      pedido.user = formToJSON(user.elements);
      console.log(JSON.stringify(pedido));
    }
  };

const formToJSON = elements => [].reduce.call(elements, (data, element) => {
  //TODO: Recursão para não haver limite de profundidade

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


  return data;
}, {});

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

/**
 * Exibe a tela de agradecimento ao leitor
 */
