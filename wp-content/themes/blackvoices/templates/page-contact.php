<?php
/*
Template Name: Contact Us
*/

get_header();?>

<main class="contact-us bg-sky" id="main">
  <div class="contact-us__hero">
    <div class="container 3xl:pt-e80">
      <h1><?= get_the_title() ?></h1>
    </div>
  </div>
  <div class="contact-us__content mb-e90 md:mb-e120">
    <div class="container">
      <form class="contact-us__form w-full md:flex md:flex-wrap" data-component="contact-us">
        <div class="form__input relative w-full md:w-1/2 md:pr-e10 mb-e30 md:mb-e50">
          <label for="first" class="block">First Name</label>
          <span class="error-message text-red-500 absolute -bottom-e20 left-e10 text-sm">Error message lorem ipsum</span>
          <input id="first" name="first" class="input block w-full input--text" type="text" />
        </div>
        <div class="form__input relative w-full md:w-1/2 md:pl-e10 mb-e30 md:mb-e50">
          <label for="last" class="block">Last Name</label>
          <span class="error-message text-red-500 absolute -bottom-e20 left-e10 text-sm">Error message lorem ipsum</span>
          <input id="last" name="last" class="input block w-full input--text" type="text" />
        </div>
        <div class="form__input relative w-full md:w-1/2 md:pr-e10 mb-e30 md:mb-e50">
          <label for="email" class="block">Email</label>
          <span class="error-message text-red-500 absolute -bottom-e20 left-e10 text-sm">Error message lorem ipsum</span>
          <input id="email" name="email" class="input block w-full input--text" type="text" />
        </div>
        <div class="form__input relative w-full md:w-1/2 md:pl-e10 mb-e30 md:mb-e50">
          <label for="company" class="block">Company</label>
          <span class="error-message text-red-500 absolute -bottom-e20 left-e10 text-sm">Error message lorem ipsum</span>
          <input id="company" name="company" class="input block w-full input--text" type="text" />
        </div>
        <div class="form__input w-full mb-e30 md:mb-e50">
          <label id="reason-label" for="reason">Reason for Inquiry</label>
          <span class="error-message text-red-500 absolute -bottom-e20 left-e10 text-sm">Error message lorem ipsum</span>
          <select id="reason" class="select" name="reason">
            <option disabled>Select One...</option>
            <option>Option 1</option>
            <option>Option 2</option>
            <option>Option 3</option>
            <option>Option 4</option>
            <option>Option 5</option>
          </select>
        </div>
        <div id="checkboxes" class="form__input relative flex flex-col w-full mb-e30 md:mb-e50">
          <label for="checkboxname">Checkboxes</label>
          <span class="error-message text-red-500 text-sm">Error message lorem ipsum</span>
          <span class="inline-flex items-center mb-8">
            <input value="1" class="checkbox mr-3" type="checkbox" name="checkboxname"/> Lorem ipsum dolor sit amet
          </span>
          <span class="inline-flex items-center mb-8">
            <input value="2" class="checkbox mr-3" type="checkbox" name="checkboxname"/> Lorem ipsum dolor sit amet
          </span>
          <span class="inline-flex items-center mb-8">
            <input value="3" class="checkbox mr-3" type="checkbox" name="checkboxname"/> Lorem ipsum dolor sit amet
          </span>
          <span class="inline-flex items-center">
            <input value="4" class="checkbox mr-3" type="checkbox" name="checkboxname"/> Lorem ipsum dolor sit amet
          </span>
        </div>
        <div id="radios" class="form__input flex flex-col w-full mb-e30 md:mb-e50">
          <label for="radioname">Radio Buttons</label>
          <span class="error-message text-red-500 text-sm">Error message lorem ipsum</span>
          <span class="inline-flex items-center mb-8">
            <input value="5" class="radio mr-3" type="radio" name="radioname"/> Lorem ipsum dolor sit amet
          </span>
          <span class="inline-flex items-center mb-8">
            <input value="6" class="radio mr-3" type="radio" name="radioname"/> Lorem ipsum dolor sit amet
          </span>
          <span class="inline-flex items-center mb-8">
            <input value="7" class="radio mr-3" type="radio" name="radioname"/> Lorem ipsum dolor sit amet
          </span>
          <span class="inline-flex items-center">
            <input value="8" class="radio mr-3" type="radio" name="radioname"/> Lorem ipsum dolor sit amet
          </span>
        </div>
        <div class="flex flex-col w-full">
          <div>
          <!-- <input class="submit" type="submit" name="form-submit"/> -->
          <?= get_component('button', [
            'title' => 'submit',
            'classes' => 'w-full md:w-auto',
            'arrow' => true
            ]) ?>
          </div>
        </div>
      </form>
    </div>
  </div><?php
  if(have_rows('location_info')) {?>
    <div class="contact-us__locations">
      <div class="container">
        <div class="locations__top mb-e10 md:mb-e30">
          <h2><?= get_field('locations_title') ?></h2>
        </div>
        <div class="locations__locations flex flex-wrap"><?php
          while(have_rows('location_info')) {
            the_row();?>
            <div class="locations__location w-full md:w-1/2">
              <div class="locations__location-inner border-orange border-t w-full py-e20 md:pt-e30 md:pb-e60">
                <?= get_sub_field('location') ?>
              </div>
            </div><?php
          }?>
        </div>
      </div>
    </div><?php
  }?>
</main>

<?php get_footer(); ?>