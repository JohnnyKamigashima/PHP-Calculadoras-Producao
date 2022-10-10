///<reference types="cypress"/>
import MainPage from "../component/main_page";

Cypress.on('uncaught:exception', (err, runnable) => {
    // returning false here prevents Cypress from
    // failing the test
    return false
})

describe('Tamanho do peso liquido por altura e largura', () => {
    it('Dado que eu visite a página de calculadoras', () => MainPage.main_page());

    it('Preencho os campos', () => {
        const $altura_fop = '295';
        const $largura_fop = '100';
        const $pais = 'EC';
        const $peso = '300';

        MainPage.elements.peso_neto_pais()
            .select($pais);
        MainPage.elements.peso_neto_altura()
            .clear()
            .type($altura_fop);
        MainPage.elements.peso_neto_largura()
            .clear()
            .type($largura_fop);
    })

    it('Entao vejo o resultado correto', () => {
        const $result = "4.8";

        MainPage.elements.peso_neto_result()
            .should('have.value', $result);
    })

})

describe('Tamanho do peso liquido por peso', () => {

    it('Preencho os campos', () => {
        const $pais = 'MX';
        const $peso = '300';

        MainPage.elements.peso_neto_pais()
            .select($pais);
        MainPage.elements.peso_neto_peso()
            .clear()
            .type($peso);
    })

    it('Entao vejo o resultado correto', () => {
        const $result = "1.5";

        MainPage.elements.peso_neto_result()
            .should('have.value', $result);
    })
})