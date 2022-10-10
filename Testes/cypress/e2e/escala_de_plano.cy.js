///<reference types="cypress"/>
import MainPage from "../component/main_page";

Cypress.on('uncaught:exception', (err, runnable) => {
  // returning false here prevents Cypress from
  // failing the test
  return false
})

describe('Calcula escala de plano', () => {
  it('Dado que eu visite a página de calculadoras', () => MainPage.main_page());

  it('Preencho os campos', () => {
    const $valor_real = '15';
    const $valor_atual = '20';

    MainPage.elements.escala_plano_medida_real()
      .clear()
      .type($valor_real);
    MainPage.elements.escala_plano_medida_atual()
      .clear()
      .type($valor_atual);
  })

  it('Entao vejo o resultado correto', () => {
    const $result = "75.00";

    MainPage.elements.escala_plano_resultado()
      .should('have.value', $result);
  })
})