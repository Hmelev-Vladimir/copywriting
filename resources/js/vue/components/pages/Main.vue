<template>
    <section class="main__welcome welcome">
        <div class="welcome__logo"> <img src="/images/logo.png" alt="Название проекта"></div>
        <div class="welcome__head">
            <div class=" welcome__head__items">
                <div class="welcome__head__item">
                    <div class="welcome__head__item__image"> <img src="/images/paper.png" alt="Название проекта">
                    </div>
                    <div class="welcome__head__item__title">Тексты на заказ</div>
                </div>
                <div class="welcome__head__item">
                    <div class="welcome__head__item__image"> <img src="/images/home.png" alt="Название проекта">
                    </div>
                    <div class="welcome__head__item__title">Настоящая работа на дому!</div>
                </div>
                <div class="welcome__head__item">
                    <div class="welcome__head__item__image"> <img src="/images/lamp.png" alt="Название проекта">
                    </div>
                    <div class="welcome__head__item__title">Магазин готовых статьей</div>
                </div>
            </div>
        </div>
        <div class="welcome__main">
            Заказывайте тексты — система найдет исполнителей и вы получите качественный
            уникальный контент в кратчайшие сроки:
        </div>
        <div class="welcome__statistics">
            <div class="welcome__statistics__image">
                <img src="/images/chart.png" alt="Название проекта">
            </div>
            <div class="welcome__statistics__text">
                <ul class="welcome__statistics__text__items">
                    <li class="welcome__statistics__text__item">Тексты для лендингов</li>
                    <li class="welcome__statistics__text__item">Копирайтинг и рерайтинг</li>
                    <li class="welcome__statistics__text__item">Инфостатьи и новости</li>
                    <li class="welcome__statistics__text__item">SEO-тексты для сайтов</li>
                </ul>
            </div>
        </div>
    </section>
</template>
<style lang="scss">
.welcome {

    display: grid;
    padding-top: 20px;
    grid-template-rows: 1fr 1fr;
    margin-top: 10px;

    &__logo {
        display: grid;
        justify-self: center;
    }


    &__head {
        display: grid;
        grid-template-columns: auto;
        grid-row: 1/2;
        grid-auto-flow: column;
        font-weight: bold;
        box-shadow: 0px 3px 3px 0px rgba(34, 60, 80, 0.2);
        color: #4d565e;
        margin-bottom: 20px;

        &__items {
            column-gap: 10px;
            display: grid;
            grid-template-columns: auto;
            grid-template-rows: 1fr;
            grid-auto-flow: column;
            column-gap: 10px;
        }

        &__item {
            display: grid;
            grid-template-columns: 80px 1fr;
            box-shadow: 0px 3px 3px 0px rgba(34, 60, 80, 0.2);
            border-radius: 15px;

            &__image {
                grid-column: 1/2;

                & img {
                    height: 80px;
                }
            }

            &__title {
                grid-column: 2/3;
                text-align: center;
                font-size: 16pt;
                padding-top: 25px;
            }
        }
    }

    &__main {
        padding-top: 10px;
        grid-row: 2/3;
        box-shadow: 0px 3px 3px 0px rgba(34, 60, 80, 0.2);
        color: #4d565e;
        font-size: 18pt;
        text-align: center;
        border-radius: 15px;
    }

    &__statistics {
        margin-top: 20px;
        display: grid;
        grid-template-columns: auto;
        grid-template-rows: 1fr;
        grid-auto-flow: column;
        text-align: center;

        &__image {
            & img {
                border-radius: 15px;
            }
        }

        &__text {
            display: grid;
            grid-template-rows: auto;
            grid-auto-flow: row;
            justify-items: center;

            &__items {}

            &__item {
                margin-top: 60px;
                font-size: 30pt;
                box-shadow: 0px 3px 3px 0px rgba(34, 60, 80, 0.2);
                color: #4d565e;
                border-radius: 15px;
            }
        }
    }
}
</style>
