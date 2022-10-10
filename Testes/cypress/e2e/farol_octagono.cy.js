///<reference types="cypress"/>
import MainPage from "../component/main_page";

Cypress.on('uncaught:exception', (err, runnable) => {
    // returning false here prevents Cypress from
    // failing the test
    return false
})

describe('Calcula largura do farol Octagono', () => {
    it('Dado que eu visite a página de calculadoras', () => MainPage.main_page())

    it('Preencho os campos', () => {
        const $altura = '190';
        const $largura = '200';
        const $pais = 'MX';

        MainPage.elements.farol_octagono_pais()
            .select($pais);
        MainPage.elements.farol_octagono_altura()
            .type($altura);
        MainPage.elements.farol_octagono_largura()
            .type($largura);
    })

    it('Obtenho resultado correto', () => {
        const $result = '35.75';

        MainPage.elements.farol_octagono_result()
            .should('have.value', $result);
    })
})