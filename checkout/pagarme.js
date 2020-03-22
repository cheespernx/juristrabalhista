const pagarme = require("pagarme");

pagarme.client.connect({ api_key: "ak_test_bU12ZdxyWAsjLXsR50hKHbvmAmFKpQ" })
.then( client => {

    client.subscriptions.create({
      plan_id: "ID DO PLANO",
      card_number: '4111111111111111',
      card_holder_name: 'Customer Teste',
      card_expiration_date: '1123',
      card_cvv: '123',
      customer: {
        document_number: '18152564000105',
        name: 'Customer Teste',
        email: 'customer@email.com',
        born_at: '17071996',
        gender: 'M',
        address: {
          street: 'Rua Fidêncio Ramos',
          complementary: 'apto',
          street_number: '308',
          neighborhood: 'pinheiros',
          city: 'São Paulo',
          state: 'SP',
          zipcode: '04551010',
          country: 'Brasil'
        },
        phone: {
          ddd: '11',
          number: '999887766'
        }
      }
    })
    .then( subscription => console.log(subscription), failure => console.log(failure) );

});